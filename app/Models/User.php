<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\Client;

class User extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'user';
    protected $fillable = ['UserName', 'Password'];

    // 更新資料
    public static function updateUserNewPW($id, $newPW)
    {
        $client = new Client("mongodb://database:27017");
        $database = $client->laravel;
        $collection = $database->user;
    
        $result = $collection->updateOne(
            ['UserName' => $id],
            ['$set' => ['Password' => $newPW]]
        );
    
        return $result;
    }
}
