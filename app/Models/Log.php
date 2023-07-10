<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'log';
    protected $fillable = ['user_id', 'action', 'details'];
    
    public static function createLog($userId, $action, $details)
    {
        self::create([
            'user_id' => $userId,
            'action' => $action,
            'details' => $details,
        ]);
    }
}