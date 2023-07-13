<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Comment;
use App\Models\User;
use App\Models\Log;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->createComment($request);
        $comment->save();

        if($request->username){
            Log::createLog($request->username, 'Store Comment', $request->CommentContent);
        } else {
            Log::createLog('unknow', 'Store Comment', $request->CommentContent);
        }

        return redirect(route('home'));
    }

    public function getUserComment($username){
        $comment = new Comment;
        return $comment->getUserComment($username);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id); //如果找不到會抛error
        $originalVisible = $comment->visible;
        
        if ($originalVisible !== $request->visible) {
            $comment->update(['visible' => $request->visible]);
        
            $logDetail = 'Comment_id: ' . $id . ', From: ' . $originalVisible . ', To: ' . $request->visible;
            Log::createLog('Manager', 'Change Comment Visible', $logDetail);
        }
    }
}
