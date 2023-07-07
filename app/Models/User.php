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
}
