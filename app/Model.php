<?php

namespace LaravelForum;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    // 複数代入を許可しないフィールドを設定、ブラックリスト形式で空なので複数代入なんでも許可
    protected $guarded = [];
}
