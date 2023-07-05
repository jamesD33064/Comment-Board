<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\Client;

class User extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'comment1data';
    protected $fillable = ['UserName', 'CommentContent', 'TimeStamp'];

    // 建立資料
    public static function createUser($data)
    {
        // return self::create($data);
        $client = new Client("mongodb://database:27017");
        $database = $client->laravel;
        $collection = $database->user;

        $result = $collection->insertOne($data);
        return $result;
    }

    // 讀取資料
    public static function getUserBy_username_pw($username, $password)
    {
        // return self::find($id);
        $client = new Client("mongodb://database:27017");
        $database = $client->laravel;
        $collection = $database->user;

        $document = $collection->find(['UserName' => $username, 'Password'=>$password]);
        return $document;
    }
    public static function getAllUser()
    {
        $client = new Client("mongodb://database:27017");
        $database = $client->laravel;
        $collection = $database->user;

        $document = $collection->find();
        return $document;
    }

    // 更新資料
    public static function updateUser($id, $data)
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
    public static function deleteUser($id)
    {
        // $comment = self::find($id);
        // if ($comment) {
        //     $comment->delete();
        //     return true;
        // }
        // return false;
    }
}
