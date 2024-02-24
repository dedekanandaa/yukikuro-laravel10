<?php

use App\Http\Controllers\blogController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\shopController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|----------
| ASSET ROUTE
|----------
*/

Route::get('/image/{filename}' , function($filename) {
    $path = storage_path('app/public/'. $filename);;
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = response($file, 200);
    $response->header('Content-Type', $type);
    return $response;
});

Route::get('/image/article/{id}/{filename}', function($id, $filename) {
    $path = storage_path('app/public/article/'. $id .'/'. $filename);;
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = response($file, 200);
    $response->header('Content-Type', $type);
    return $response;
});

Route::get('/image/product/{id}/{filename}', function($id, $filename) {
    $path = storage_path('app/public/product/'. $id .'/'. $filename);;
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = response($file, 200);
    $response->header('Content-Type', $type);
    return $response;
});

/*
|----------
| WEB ROUTE
|----------
*/

Route::get('/', function () {
    return view('/home.index');
});

Route::get('/blog', function () {
    return view('/blog.index');
});

Route::get('/about', function () {
    return view('about.index');
});

Route::controller(homeController::class)->group(function () {
    Route::get('/', 'index');
});

Route::controller(shopController::class)->group(function () {
    Route::get('/shop', 'index');
    Route::get('/shop/{product_name}', 'product');
});

// Route::controller(aboutController::class)->group(function () {
//     Route::get('/about', 'index');
// });

Route::controller(blogController::class)->group(function () {
    Route::get('/blog', 'index');
    Route::get('/blog/{title}', 'article');
});

Route::get('/cona' , function() {
    return view('my-component');
});