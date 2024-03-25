<?php

use App\Http\Controllers\blogController;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\dashboardBlogController;
use App\Http\Controllers\dashboardHomepageController;
use App\Http\Controllers\dashboardShopController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\shopController;
use App\Http\Middleware\AccessAdmin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|----------
| ASSET ROUTE
|----------
*/

Route::get('/image/home/{filename}' , function($filename) {
    $path = storage_path('app/public/home/'. $filename);;
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

Route::get('/about', function () {
    return view('about.index');
});

Route::get('/refresh', function() {
    session()->flush();
    return back();
});

Route::controller(dashboard::class)->group(function() {
    Route::get('/dashboard/login', 'login');
    Route::post('/dashboard/loginprocess', 'loginProcess');

});

Route::middleware([AccessAdmin::class])->group(function() {
    Route::controller(dashboard::class)->group(function () {
        Route::get('/dashboard/logout', 'logout');
        Route::get('/dashboard', 'index');
    });

    Route::controller(dashboardShopController::class)->group(function () {
        
        Route::get('/dashboard/product', 'readProduct');
    
        Route::get('/dashboard/product/new', 'c_product');
        Route::post('/dashboard/product/create', 'createProduct');
    
        Route::get('/dashboard/product/edit/{id}', 'u_product');
        Route::post('/dashboard/product/edit', 'updateProduct');
    
        Route::get('/dashboard/product/delete/{id}', 'd_product');
    });
    
    Route::controller(dashboardBlogController::class)->group(function () {
        Route::get('/dashboard/blog', 'r_blog');
    
        Route::get('/dashboard/blog/new', 'c_blog');
        Route::post('/dashboard/blog/create', 'createBlog');
    
        Route::get('/dashboard/blog/edit/{id}', 'u_blog');
        Route::post('/dashboard/blog/edit', 'updateBlog');
    
        Route::get('/dashboard/blog/delete/{id}', 'd_blog');
        Route::get('/dashboard/content/delete/{id}', 'd_content');
        Route::get('/dashboard/detail/delete/{id}', 'd_detail');
    });
    
    Route::controller(dashboardHomepageController::class)->group(function () {
        Route::get('/dashboard/homepage', 'index');
        Route::post('/dashboard/homepage/edit', 'editHome');
    });
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