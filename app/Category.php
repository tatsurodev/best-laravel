<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // CategoriesControllerの静的メソッドcreateを使った複数代入を許可するため
    protected $fillable = ['name'];
}
