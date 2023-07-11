<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;

use App\Models\Comment;
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

        Log::createLog($request->UserName, 'Store Comment', $request->CommentContent);
        return redirect(route('home'));
    }

    public static function Top10_ActiviteUser(){
        $users = Comment::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$group' => [
                        '_id' => '$UserName',
                        'count' => ['$sum' => 1]
                    ]
                ],
                [
                    '$sort' => ['count' => -1]
                ]
            ]);
        });
        
        $userRecords = [];
        foreach ($users as $user) {
            $userRecords[$user['_id']] = $user['count'];
        }
        
        arsort($userRecords);
        return $userRecords;
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id); //如果找不到会抛error
        $originalVisible = $comment->visible;
        
        if ($originalVisible !== $request->visible) {
            $comment->update(['visible' => $request->visible]);
        
            $logDetail = 'Comment_id: ' . $id . ', From: ' . $originalVisible . ', To: ' . $request->visible;
            Log::createLog('Manager', 'Change Comment Visible', $logDetail);
        }
    }
}
