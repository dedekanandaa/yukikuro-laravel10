<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index()
    {
        $article = DB::table('article')
        ->orderBy('id', 'desc')
        ->limit(6)
        ->get();

        $product = DB::table('product')
        ->orderBy('id', 'desc')
        ->limit(6)
        ->get();

        return view('home.index')
        ->with('article', $article)
        ->with('product', $product);
    }
}
