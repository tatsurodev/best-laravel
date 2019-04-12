<?php

namespace LaravelForum;

class Discussion extends Model
{

    // ルートモデルバインディング使用時のprimary keyをslugに変更
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
