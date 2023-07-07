<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\Client;

class Manager_User extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'manager_user';
    protected $fillable = ['UserName', 'Password'];
}
