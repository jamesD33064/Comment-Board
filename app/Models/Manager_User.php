<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MongoDB\Client;

class Manager_User extends Model
{
    public static function getUserPWBy_username($username)
    {
        $client = new Client("mongodb://database:27017");
        $database = $client->laravel;
        $collection = $database->manager_user;
        
        $document = $collection->findOne(['UserName' => $username]);
        if ($document) {
            $PW = $document->Password;
            return $PW;
        } else {
            return '找不到該使用者';
        }
    }
}
