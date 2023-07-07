<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class CommentTableController extends Controller
{
    public function index()
    {
        $AllComment = Comment::where('visible', 'block')
                    ->get();
        return view('comment',['commentdata' => $AllComment]);
    }
}