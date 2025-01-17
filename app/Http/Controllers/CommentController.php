<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Blog $blog){
        request()->validate([
            "body"=>['required','min:3']
        ]);
        $blog->comments()->create([
            "body"=>request('body'),
            "user_id"=>auth()->user()->id,
            "blog_id"=>$blog->id
        ]);

        return back();
    }
}
