<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|----------
| ASSET ROUTE
|----------
*/

Route::get('/image/{filename}', function($filename) {
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

/*
|----------
| WEB ROUTE
|----------
*/

Route::get('/', function () {
    return view('/template/home');
});

Route::get('/shop', function () {
    return view('/shop/shop');
});

Route::get('/shop/{product_name}', function () {
    return view('/shop/product');
});

Route::get('/blog', function () {
    return view('/blog/blog');
});

Route::get('/blog/{article_name}', function () {
    return view('/blog/article');
});

Route::get('/about', function () {
    return view('about');
});
