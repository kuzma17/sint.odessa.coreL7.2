<?php

namespace App\Http\Controllers;

use App\News;
use App\Page;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    public function search(Request $request){
        if($request->isMethod('post')) {

            $this->validate($request, ['search' => 'required|min:4'] );

            $query = $request->input('search');
            $page = json_decode(Page::search($query)->get());
            $news = json_decode(News::search($query)->get());
            $post = json_decode(Post::search($query)->get());

            $results = array_merge($page, $news, $post);

            return view('search', ['query' => $query, 'results' => $results]);
        }
    }
}
