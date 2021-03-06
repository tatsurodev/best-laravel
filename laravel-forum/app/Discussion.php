<?php

namespace LaravelForum;

use LaravelForum\Notifications\ReplyMarkedAsBestReply;

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

    // ベストリプライのインスタンスを取得
    public function getBestReply()
    {
        return Reply::find($this->reply_id);
    }

    // DiscussionとReplyのリレーション
    public function bestReply()
    {
        return $this->belongsTo(Reply::class, 'reply_id');
        // return $this->hasOne(Reply::class, 'id', 'reply_id');
    }

    public function markAsBestReply(Reply $reply)
    {
        $this->update([
            'reply_id' => $reply->id,
        ]);
        // 通知設定
        if ($reply->owner->id !== $this->author->id) {
            $reply->owner->notify(new ReplyMarkedAsBestReply($reply->discussion));
            // $reply->owner->notify(new ReplyMarkedAsBestReply($this));
        }
    }

    public function scopeFilterByChannels($builder)
    {
        if (request()->query('channel')) {
            $channel = Channel::where('slug', request()->query('channel'))->first();
            if ($channel) {
                return $builder->where('channel_id', $channel->id);
            } else {
                return $builder;
            }
        }
    }
}
