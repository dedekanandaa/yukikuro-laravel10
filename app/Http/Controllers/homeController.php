<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index()
    {
        $article = DB::table('article')
        ->orderByDesc('id')
        ->limit(6)
        ->get();

        $product = DB::table('product')
        ->select( 'product.id','product.name','product.thumbnail', 'product.price', DB::raw('SUM(qty) as total'))
        ->join('stock', 'product.id', '=', 'stock.id_product')
        ->groupBy( 'product.id','product.name', 'product.thumbnail', 'product.price')
        ->orderByDesc('product.id')
        ->get();


        return view('home.index')
        ->with('article', $article)
        ->with('product', $product);
    }
}
