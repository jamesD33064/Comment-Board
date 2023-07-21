<?php

namespace App\Models;

use Illuminate\Http\Request;
use Jenssegers\Mongodb\Eloquent\Model;

class PermissionRole extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'PermissionRole';
    protected $fillable = ['RoleName', 'Permission'];


    public function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function exists($RoleName): bool
    {
        return self::where('RoleName', $RoleName)->exists();
    }

    public function createRole(String $RoleName, String $Permission)
    {
        if (!$this->isJson($Permission)) {//如果不是json
            return false;
        }
        if ($this->exists($RoleName)) {//如果存在一樣的名子
            return false;
        }

        $this->fill([
            'RoleName' => $RoleName,
            'Permission' => $Permission,
        ]);
        return true;
    }
}
