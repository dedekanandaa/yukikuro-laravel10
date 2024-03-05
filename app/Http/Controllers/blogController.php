<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class blogController extends Controller
{
    public function index() { 
        $article = DB::table('article')
        ->orderBy('id', 'desc')
        ->get();
        
        return view('blog.index')->with('article', $article);
    }
    
    public function article($title) {
        $article = DB::table('article')
        ->where('title', $title)
        ->get();

        $content= DB::table('content')
        ->where('id_article', $article->value('id'))
        ->get();

        $detail = DB::table('content_detail')
        ->select('content_detail.*')
        ->join('content','content.id','=', 'content_detail.id_content')
        ->where('id_article', $article->value('id'))
        ->get();

        return view('blog.article')
        ->with('article', $article)
        ->with('content', $content)
        ->with('detail', $detail);
    }

}
