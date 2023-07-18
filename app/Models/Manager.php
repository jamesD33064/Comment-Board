<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Manager extends Model implements Authenticatable
{
    use AuthenticableTrait;
    protected $connection = 'mongodb';
    protected $collection = 'manager';

    protected $fillable = [
        'username',
        'password',
        'name',
        'email',
        'status',
        'permission'
    ];

    public function createUser($data)
    {
        $this->fill([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'email' => '@',
            'status' => $data['status'],
            'permission' => '0'
        ]);
    }
}
