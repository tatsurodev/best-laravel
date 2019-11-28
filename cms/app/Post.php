<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;
    // date型フィールドを登録して比較可能に
    protected $dates = [
        'published_at'
    ];

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

    // 検索用スコープ
    public function scopeSearched($query)
    {
        // getから検索ワードゲット
        $search = request()->query('search');
        if (!$search) {
            // 検索ワードがなければそのまま
            return $query->published();
        } else {
            // タイトルを検索ワードで絞り込み
            return $query->published()->where('title', 'LIKE', "%{$search}%");
        }
    }

    // 公開済みスコープ
    public function scopePublished($query)
    {
        // nullでも公開扱い
        return $query->where('published_at', '<=', now())->orWhereNUll('published_at');
    }
}
