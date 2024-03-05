<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Command\WhereamiCommand;

class shopController extends Controller
{
    public function index() {
        $product = DB::table('product')
        ->select( 'product.id','product.name','product.thumbnail', 'product.price', DB::raw('SUM(qty) as total'))
        ->join('stock', 'product.id', '=', 'stock.id_product')
        ->groupBy( 'product.id','product.name', 'product.thumbnail', 'product.price')
        ->orderByDesc('product.id')
        ->get();

        // return $product;
        return view('shop.index')->with('product', $product);
    }
    
    public function product($productname) {
        $product = DB::table('product')
        ->where('name', $productname)
        ->get();

        $stock = DB::table('stock')
        ->where('id_product', $product[0]->id)
        ->get();

        return view('shop.product')
        ->with('product', $product)
        ->with('stock', $stock);
    }
}
