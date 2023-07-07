<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\Client;

class Comment extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'comment1data';
    protected $fillable = ['UserName', 'CommentContent', 'visible', 'created_at'];
}
