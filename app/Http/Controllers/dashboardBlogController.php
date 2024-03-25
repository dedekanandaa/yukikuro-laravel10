<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

class dashboardBlogController extends Controller
{
    public function r_blog() {
        $article = DB::table("article")
        ->orderByDesc('id')
        ->where('id', '>', 1)
        ->get();
        
        return view('dashboard.r-blog')
        ->with('article', $article);
    }
    public function c_blog() {
        return view('dashboard.c-blog');
    }
    
    public function createBlog(Request $request) {
        $request->validate([
            'title' => 'required|string|max:100',
            'thumbnail' => 'required|mimes:jpeg,png,jpg,webp,gif',
            'description' => 'required|string',
        ]);

        try {
            $filename = pathinfo($request->file('thumbnail')->hashName(), PATHINFO_FILENAME);
            $name = $filename . '.webp';

            DB::beginTransaction();
            DB::table('article')
            ->insert([
                'title' => $request->title,
                'thumbnail' => $name,
                'description' => $request->description,
            ]);

            $id = DB::table('article')->orderByDesc('id')->value('id');
            Storage::makeDirectory('public/article/'.$id);

            $manager = new ImageManager(Driver::class);
            $file = $request->file('thumbnail');
            $image = $manager->read($file);
            $image->scale(width:1280);
            $encoded = $image->encode(new WebpEncoder(quality: 80));
            $encoded->save(storage_path('app/public/article/'.$id.'/'. $name));

            DB::commit();

            if ($request->submit) {
                return $this->newContent($id, $request->submit, $request->many_cols);
            } else {
                return $this->u_blog($id)->with('success', 'new blog posted!');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Storage::deleteDirectory('public/article/'.$id);
            $error = $th->getMessage();
            return back()->withErrors(['errors' => $error]);
        }
    }
    public function u_blog($id) {
        $article = DB::table("article")
        ->where('id', $id)
        ->first();

        $content = DB::table('content')
        ->where('id_article', $id)
        ->get();
        
        $detail = DB::table('content_detail')
        ->whereIn('id_content', $content->pluck('id'))
        ->get();

        return view('dashboard.u-blog')
        ->with('article', $article)
        ->with('content', $content)
        ->with('detail', $detail);
    }

    public function updateBlog(Request $request) {  

        try {
            DB::beginTransaction();
            DB::table('article')
            ->where('id', $request->id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
                'visibility' => ($request->visibility == true),
            ]);
                    
            if (!empty($request->file('image'))) {
                foreach ($request->file('image') as $key => $file){
                    
                    $id = $request->id;
                    $manager = new ImageManager(Driver::class);
                    $image = $manager->read($file);
                    $filename = pathinfo($file->hashName(), PATHINFO_FILENAME);
                    
                    if (!$image->isAnimated()) {
                        $name = $filename . '.webp';
                        $image->scale(width:600);
                        $encoded = $image->encode(new WebpEncoder(quality: 80));
                        $encoded->save(storage_path('app/public/article/'.$id.'/'. $name));
                    } else {
                        $name = $file->hashName();
                        $image->scale(width:600)
                        ->save(storage_path('app/public/article/'.$id.'/'. $name), quality: 80);
                    }
                    
                    DB::table('content_detail')
                    ->where('id', $key)
                    ->update([
                        'description' => $name
                    ]);
                    
                } 
            } 

            if (!empty($request->file('thumbnail'))) {
                $filename = pathinfo($request->file('thumbnail')->hashName(), PATHINFO_FILENAME);
                $name = $filename . '.webp';

                $old = DB::table('article')->where('id', $request->id)->value('thumbnail');
                Storage::delete('public/article/'.$request->id.'/'.$old);
                
                DB::table('article')
                ->where('id', $request->id)
                ->update([
                    'thumbnail' => $name
                ]);
                
                $id = $request->id;
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($request->file('thumbnail'));
                $image->scale(width:1280);
                $encoded = $image->encode(new WebpEncoder(quality: 80));
                $encoded->save(storage_path('app/public/article/'.$id.'/'. $name));
            } 
            
            if (!empty($request->text)) {
                foreach ($request->text as $key => $text){
                    DB::table('content_detail')
                    ->where('id', $key)
                    ->update([
                        'description' => $text
                    ]);
                }
            }

            if ($request->submit > 0) {
                $this->newContent($request->id, $request->submit, $request->many_cols);
            } elseif($request->submit < 0) {
                $data = explode(',',$request->submit);
                $this->newContentDetail($data[1], abs($data[0]));
            }
            
            DB::commit();
            return back()->with('success', 'blog has been updated');
        } catch (\Throwable $th) {
            DB::rollBack();
            $error = $th->getMessage();
            return back()->withErrors(['errors' => $error]);
        }

    }

    public function newContentDetail($id, $type) {
        DB::table('content_detail')
        ->insert([
            'id_content' => $id,
            'type' => $type,
        ]);
    }

    public function newContent($id, $type, $many_cols) {
        DB::table('content')
        ->insert([
            'id_article' => $id,
        ]);

        $id_content = DB::table('content')->select('id')->orderBy('id', 'desc')->first()->id;

        for($i=0; $i<$many_cols; $i++) {
            DB::table('content_detail')
            ->insert([
                'id_content' => $id_content,
                'type' => $type,
            ]);
        }
    }

    public function d_blog($id) {
        try {
            DB::beginTransaction();
            DB::table('article')
            ->delete($id);
            DB::commit();
            return redirect('/dashboard/blog')->with('success', 'Data Updated Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            $error = $th->getMessage();
            return back()->withErrors(['errors' => $error]);
        }
    }
    public function d_content($id) {
        try {
            DB::beginTransaction();
            DB::table('content')
            ->delete($id);
            DB::commit();
            return back()->with('success', 'Data Updated Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            $error = $th->getMessage();
            return back()->withErrors(['errors' => $error]);
        }
    }
    public function d_detail($id) {
        try {
            DB::beginTransaction();
            DB::table('content_detail')
            ->delete($id);
            DB::commit();
            return back()->with('success', 'Data Updated Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            $error = $th->getMessage();
            return back()->withErrors(['errors' => $error]);
        }
    }

}
