<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'description' , 'content', 'image', 'published_at', 'category_id', 'user_id'
    ];

    /**
     * Delete post image from storage.
     *
     * @return void
     */

    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    public function category()
    {
        // Category::classは、'App\Category'に変換される。
        // 1:!の関係(Categoryが主、Postが従)、自動的にPostモデルのcategory_idフィールドとcategoryモデルのidフィールドが関連付けられる
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        // 多対多の関係を定義
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Check if post has tag
     *
     * @return bool
     */

    public function hasTag($tagID)
    {
        return in_array($tagID, $this->tags->pluck('id')->toArray());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
