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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo 'index';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->UserName = $request->UserName;
        $comment->CommentContent = $request->CommentContent;
        $comment->visible = 'block';
        $comment->save();

        Log::createLog($request->UserName, 'Store Comment', $request->CommentContent);
        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo 'show';
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $original_visible='';
        
        $comment = Comment::find($id);
        $original_visible = $comment->visible;
        $comment->visible = $request->visible;
        $comment->save();

        $log_detail = 'Comment_id:'.$id.' ,From:'.$original_visible.' ,To:'.$request->visible;
        Log::createLog('Manager', 'Change Comment Visible', $log_detail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo 'destroy';
    }
}
