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
            'user_id' => 'required|integer',
            'comment' => 'required|string',
            'user_name' => 'required|string|max:255'
        ]);

        $comment = Comment::create($request->all());
        return response()->json($comment, 201);
    }
}
