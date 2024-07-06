<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
       

        $request->validate([            
            'body' => 'required'
        ]);

      
        // Simpan komentar ke database
        $comment = new Comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->user()->id;
        $comment->body = $request->body;
      
        $comment->save();

        return redirect()->route('posts.show', ['post' => $comment->post->slug]);
    }

}
