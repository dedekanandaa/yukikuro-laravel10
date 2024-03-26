<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class blogController extends Controller
{
    public function index() { 
        $article = DB::table('article')
        ->orderBy('id', 'desc')
        ->where('visibility', true)
        ->get();
        
        return view('blog.index')->with('article', $article);
    }
    
    public function article($id) {
        $article = DB::table('article')
        ->where('id', $id)
        ->get();

        $content= DB::table('content')
        ->where('id_article', $id)
        ->get();

        $detail = DB::table('content_detail')
        ->select('content_detail.*')
        ->join('content','content.id','=', 'content_detail.id_content')
        ->where('id_article', $id)
        ->get();

        return view('blog.article')
        ->with('article', $article)
        ->with('content', $content)
        ->with('detail', $detail);
    }

}
