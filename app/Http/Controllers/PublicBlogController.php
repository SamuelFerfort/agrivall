<?php

namespace App\Http\Controllers;

use App\Models\PostBlog;

class PublicBlogController extends Controller
{
    public function index()
    {
        $posts = PostBlog::with('tipoPost')->orderBy('fecha_public', 'desc')->get();

        return view('public.blog.index', compact('posts'));
    }

    public function show(PostBlog $post)
    {
        $post->load('tipoPost');

        return view('public.blog.show', compact('post'));
    }
}
