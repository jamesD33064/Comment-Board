<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class CommentTableController extends Controller
{
    // public function index(){
    //     // return view('comment',['commentdata' => $collection->find()]);
    // }

    public function index()
    {
        // $documents = Comment::all();
        
        // $collection = DB::connection('mongodb')->collection('comment1data');
        // $documents = $collection->find(['UserName' => 'TestUser']);
        // foreach ($documents as $user) {
        //     echo $user['CommentContent'] . ' - ' . $user['UserName'] . ' - ' . $user['TimeStamp'] . '<br>';
        // }

        $AllComment = Comment::getAllComment();
        return view('comment',['commentdata' => $AllComment]);
        // foreach ($AllComment as $SingalComment) {
        //     echo $SingalComment['CommentContent'] . ' - ' . $SingalComment['UserName'] . ' - ' . $SingalComment['TimeStamp'] . '<br>';
        // }
        

    }
}