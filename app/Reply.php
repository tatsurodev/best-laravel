<?php

namespace LaravelForum;

class Reply extends Model
{
    public function owner()
    {
        return $this->belognsTo(User::class, 'user_id');
    }

    public function discussion()
    {
        $this->belongsTo(Discussion::class);
    }
}
