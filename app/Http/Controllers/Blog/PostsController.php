<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\Category;
use App\Tag;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        return view('blog.show')->with('post', $post);
    }

    public function category(Category $category)
    {
        // getから検索ワードゲット
        $search = request()->query('search');
        if ($search) {
            // カテゴリーから関連ポストを取得、更にタイトルを検索ワードで絞り込み
            $posts = $category->posts()->where('title', 'LIKE', "%{$search}%")->simplePaginate(2);
        } else {
            // カテゴリーの関連ポスト一覧
            $posts = $category->posts()->simplePaginate(2);
        }
        return
            view('blog.category')
            ->with('category', $category)
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts', $posts)
        ;
    }

    public function tag(Tag $tag)
    {
        return
            view('blog.tag')
            ->with('tag', $tag)
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts', $tag->posts()->simplePaginate(2))
        ;
    }
}
