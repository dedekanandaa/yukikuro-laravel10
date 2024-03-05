<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

class dashboardController extends Controller
{
    public function index() {
        return view('dashboard.index');
    }

    public function readProduct() {
        $product = DB::table('product')
        ->orderBy('id', 'desc')
        ->get();
        
        $stock = DB::table('stock')
        ->get();

        // return $product;
        return view('dashboard.product')
        ->with('product', $product)
        ->with('stock', $stock);
    }

    public function c_product() {
        return view('dashboard/c-product');
    }
    
    public function createProduct(Request $request) {

        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|integer',
            'description' => 'required|string|',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        try {
            $filename = pathinfo($request->file('thumbnail')->hashName(), PATHINFO_FILENAME);
            $name = $filename . '.webp';

            DB::beginTransaction();
            DB::table('product')
            ->insert([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'visibility' => false,
                'thumbnail' => $name
            ]);
    
            $id = DB::table('product')->select('id')->orderBy('id', 'desc')->first()->id;
            Storage::makeDirectory('public/product/'.$id);
            
            $manager = new ImageManager(Driver::class);
            $file = $request->file('thumbnail');
            $image = $manager->read($file);
            $image->scale(width:600);
            $encoded = $image->encode(new WebpEncoder(quality: 75));
            $encoded->save(storage_path('app/public/product/'.$id.'/'. $name));
            
            if ($request->hassize == true) {
                for($i=0; $i<5 ; $i++) {
                    DB::table('stock')
                    ->insert([
                        'id_product' => $id,
                        'size' => $i+1,
                        'qty' => 0 . $request->{'qty_'.$i},
                    ]);
                }
            } else {
                DB::table('stock')
                ->insert([
                    'id_product' => $id,
                    'qty' => 0 . $request->qty,
                ]);
            }

            DB::table('product_image')
            ->insert([
                'id_product' => $id
            ]);
            
            DB::commit();
            return redirect('dashboard/product')->with('success', 'New product added successfully!');
            
        } catch (\Throwable $th) {
            
            Storage::deleteDirectory('public/product/'.$id);
            DB::rollBack();
            $error = $th->getMessage();
            return back()->withErrors(['errors' => $error]);
        }

    }

    public function u_product($id) {
        $product = DB::table('product')
        ->where('id', $id)
        ->first();

        $stock = DB::table('stock')
        ->where('id_product', $id)
        ->get();

        $image = DB::table('product_image')
        ->where('id_product', $id)
        ->get();

        return view('dashboard.u-product')
        ->with('product', $product)
        ->with('stock', $stock)
        ->with('image', $image);
    }

    public function updateProduct(Request $request) {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|integer',
            'description' => 'required|string|',
        ]);
        
        try {
            DB::beginTransaction();
            DB::table('product')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'visibility' => ($request->visibility == true)
            ]);

            if (!empty($request->thumbnail)) {
                $filename = pathinfo($request->file('thumbnail')->hashName(), PATHINFO_FILENAME);
                $name = $filename . '.webp';

                DB::table('product')
                ->where('id', $request->id)
                ->update([
                    'thumbnail' => $name
                ]);

                $id = DB::table('product')->select('id')->orderBy('id', 'desc')->first()->id;
                $manager = new ImageManager(Driver::class);
                $file = $request->file('thumbnail');
                $image = $manager->read($file);
                $encoded = $image->encode(new WebpEncoder(quality: 75));
                $encoded->save(storage_path('app/public/product/'.$id.'/'. $name));
            }

            if ($request->hassize == true) {
                for($i=0; $i<5 ; $i++) {
                    DB::table('stock')
                    ->where('id', $request->{'id_stock_'.$i})
                    ->update([
                        'qty' => 0 . $request->{'qty_'.$i},
                    ]);
                }
            } else {
                DB::table('stock')
                ->where('id', $request->id_stock)
                ->update([
                    'qty' => 0 . $request->qty,
                ]);
            }
            DB::commit();
            return back()->with('success', "Product Updated Successfully");

        } catch (\Throwable $th) {
            DB::rollBack();
            $error = $th->getMessage();
            return back()->withErrors(['errors' => $error]);
        }

    }

    public function d_product($id) {
        try {
            DB::beginTransaction();
            DB::table('product_image')
            ->where('id_product', $id)
            ->delete();
            DB::table('stock')
            ->where('id_product', $id)
            ->delete();
            DB::table('product')
            ->where('id', $id)
            ->delete();
            Storage::deleteDirectory('public/product/'.$id);
            DB::commit();
            return redirect('dashboard/product')->with('success', 'Product Deleted Successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            $error = $th->getMessage();
            return back()->withErrors(['errors' => $error]);
        }
    }

    public function tesimage(Request $request) {
        $files = [];
        foreach ($request->file('images') as $file) {
            $file_name = time().rand(1,99).'.'.$file->extension();
            $files[]['name'] = $file_name;
            return $file;
        }
        return $files;
    }
    
}
