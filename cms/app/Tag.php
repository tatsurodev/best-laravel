<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function posts()
    {
        // 多対多の関係を定義
        return $this->belongsToMany(Post::class);
    }
}
