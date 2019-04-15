<?php

namespace LaravelForum;

class Discussion extends Model
{
    // Userモデル(親)とDiscussion(子)のリレーションを定義
    // hasOne, hasMany, belongsTo引数共通
    // 第２引数に子テーブルの外部キー、第３引数に親テーブルの主キー
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function replies()
    {
        return $this->hasmany(Reply::class);
    }

    // ルートモデルバインディング使用時のprimary keyをslugに変更
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function markAsBestReply(Reply $reply)
    {
        $this->update([
            'reply_id' => $reply->id,
        ]);
    }
}
