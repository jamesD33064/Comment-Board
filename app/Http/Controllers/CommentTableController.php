<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class CommentTableController extends Controller
{
    public function index()
    {
        $AllComment = Comment::where('visible', 'block')->orderBy('created_at', 'desc')->get();
        return view('welcome',['commentdata' => $AllComment]);
    }
}