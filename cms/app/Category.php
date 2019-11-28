<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // CategoriesControllerの静的メソッドcreateを使った複数代入を許可するため
    protected $fillable = ['name'];

    // 1:多の関係(Categoryが主、Postが従)
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
