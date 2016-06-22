<?php

namespace App\Http\Controllers\Blog;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at','dsc');

        return view('index')
            ->with('posts', $posts->get())
            ->with('postsPaginated',$posts->simplePaginate(5));
    }

    public function getPost($id)
    {
        $posts = Post::orderBy('created_at','dsc');
        $post = Post::find($id);

        return view('viewPost', compact('post'))
            ->with('posts', $posts->get())
            ->with('postsPaginated',$posts->simplePaginate(5));
    }

    public function about()
    {
        $posts = Post::orderBy('created_at','dsc');
        return view('about')
            ->with('posts', $posts->get());
    }
}
