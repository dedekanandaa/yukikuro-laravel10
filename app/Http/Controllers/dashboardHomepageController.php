<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

class dashboardHomepageController extends Controller
{
    public function index() {
        return view('dashboard.homepage');
    }

    public function editHome(Request $request) {
        try {
            $manager = new ImageManager(Driver::class);
            
            if (!empty($request->file('logo'))) {
                $file = $request->file('logo');
                $image = $manager->read($file);
                
                if (!$image->isAnimated()) {
                    $image->scale(height:64);
                    $encoded = $image->encode(new WebpEncoder(quality: 80));
                    $encoded->save(storage_path('app/public/home/logo.webp'));
                } else {
                    $image->scale(width:100)
                    ->save(storage_path('app/public/home/logo.'. $file->getClientMimeType()), quality: 80);
                }
            }
    
            if (!empty($request->thumbnail)) {
                $file = $request->file('thumbnail');   
                $image = $manager->read($file);
                
                if (!$image->isAnimated()) {
                    $image->scale(width:1280);
                    $encoded = $image->encode(new WebpEncoder(quality: 80));
                    $encoded->save(storage_path('app/public/home/header.webp'));
                } else {
                    $image->scale(width:1280)
                    ->save(storage_path('app/public/home/header.'.$file->getClientMimeType()), quality: 80);
                }
            }

            return back()->with('success', 'homepage updated');

        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return back()->withErrors(['errors' => $error]);
        }

    }
}
