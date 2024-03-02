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

    public function r_product() {
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

    public function newProduct() {
        return view('dashboard/c-product');
    }
    
    public function c_product(Request $request) {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $filename = pathinfo($request->file('thumbnail')->hashName(), PATHINFO_FILENAME);
        $name = $filename . '.webp';
        try {
            DB::beginTransaction();
            DB::table('product')
            ->insert([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'thumbnail' => $name,
                'visibility' => false,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $error = $th->getMessage();
            return redirect('dashboard/product')->with('errors', $error);
        }
        $id = DB::table('product')->select('id')->orderBy('id', 'desc')->first()->id;
        $manager = new ImageManager(Driver::class);
        $file = $request->file('thumbnail');
        $image = $manager->read($file);
        $encoded = $image->encode(new WebpEncoder(quality: 75));
        Storage::makeDirectory('public/product/'.$id);
        $encoded->save(storage_path('app/public/product/'.$id.'/'. $name));

        return redirect('dashboard/product')->with('success', 'New product added sucessfully!');
    }

    public function updateProduct($id) {
        $product = DB::table('product')
        ->where('id', $id)
        ->first();

        return view('dashboard.u-product')->with('product', $product);
    }
    public function u_product(Request $request) {
        try {
            DB::beginTransaction();
            DB::table('product')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'visibility' => $request->visibility
            ])
            
            ;
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $error = $th->getMessage();
            return $this->r_product()->with('error', $error);
        }
        if (!empty($request->name)) {
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

        if (!empty($request->images)) {
            // DB::table('product_image')
            // ->insert();
        }

        if (!empty($request->hassize)) {

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
