<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostRequest;

use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        // 画像アップロード
        $image = $request->image->store('posts');
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
        ]);
        session()->flash('success', 'Post created successfully.');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // 受け取るnameを限定
        $date = $request->only(['title', 'description', 'content', 'published_at']);
        // 画像のアップデート
        if ($request->hasFile('image')) {
            // 新しい画像のアップロード
            $image = $request->image->store('posts');
            // 古い画像の削除
            $post->deleteImage();
            // 新しい画像のパスを更新用配列に追加
            $date['image'] = $image;
        }
        // ポストを更新
        $post->update($date);
        session()->flash('success', 'Post updated successfully.');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // route model bindingは、soft deletingではデーターベース上にないことになっているので該当レコードを取得できない。よって必須パラメーターから抽出する
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if ($post->trashed()) {
            // 画像ファイルの削除
            $post->deleteImage();
            // 該当レコードの完全削除
            $post->forceDelete();
        } else {
            // 該当レコードのソフトデリート
            $post->delete();
        }
        session()->flash('success', 'Post deleted  successfully.');
        return redirect(route('posts.index'));
    }

    /**
     * Display a list of all trashed posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts', $trashed);
        //return view('posts.index')->withPosts($trashed);
    }

    // restoreするデータはtrashedされて削除されていることになっているのでroute mode bindingでは取得できない。よって該当レコードを必須パラメーターから抽出する
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        session()->flash('success', 'Post restored  successfully.');
        return redirect()->back();
    }
}
