<?php

namespace App\Models;
use Illuminate\Http\Request;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\Client;

class Comment extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'comment1data';
    protected $fillable = ['UserName', 'CommentContent', 'visible'];

    public function createComment(Request $request)
    {
        $this->fill([
            'UserName' => $request->UserName,
            'CommentContent' => $request->CommentContent,
            'visible' => 'block',
        ]);
    }
}
