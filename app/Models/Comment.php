<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\Client;

class Comment extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'comment1data';
    protected $fillable = ['UserName', 'CommentContent', 'TimeStamp'];

    // 建立資料
    public static function createComment($data)
    {
        // return self::create($data);
        $client = new Client("mongodb://database:27017");
        $database = $client->laravel;
        $collection = $database->comment1data;

        $result = $collection->insertOne($data);
        return $result;
    }

    // 讀取資料
    public static function getCommentById($id)
    {
        // return self::find($id);
    }
    public static function getAllComment()
    {
        $client = new Client("mongodb://database:27017");
        $database = $client->laravel;
        $collection = $database->comment1data;

        $document = $collection->find();
        return $document;
    }

    // 更新資料
    public static function updateComment($id, $data)
    {
        // $comment = self::find($id);
        // if ($comment) {
        //     $comment->fill($data);
        //     $comment->save();
        //     return $comment;
        // }
        // return null;
    }

    // 刪除資料
    public static function deleteComment($id)
    {
        // $comment = self::find($id);
        // if ($comment) {
        //     $comment->delete();
        //     return true;
        // }
        // return false;
    }
}
