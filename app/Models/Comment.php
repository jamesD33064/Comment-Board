<?php

namespace App\Models;

use Illuminate\Http\Request;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

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

    public function Top10_ActiviteUser()
    {
        // top10ActiviteUser
        $pipeline = [
            [
                '$group' => [
                    '_id' => '$UserName',
                    'count' => ['$sum' => 1]
                ]
            ],
            [ '$sort' => ['count' => -1] ],
            [ '$limit' => 10 ]
        ];

        return $this->raw()->aggregate($pipeline);
    }

    public function getUserComment($UserName)
    {
        return $this->where('UserName', $UserName)->get();
    }
}
