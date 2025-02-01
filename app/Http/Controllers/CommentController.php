<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index($product_id){
        $comments = Comment::where('product_id', '=', intval($product_id))->get();
        return response()->json($comments);
    }

    public function store(Request $request){
        $request->validate([
            'post_id' => 'required|integer',
            'user_id' => 'required|integer',
            'comment' => 'required|string'
        ]);

        $comment = Comment::create($request->all());
        return response()->json($comment, 201);
    }
}
