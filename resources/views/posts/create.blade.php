@extends('layouts.app')
@section('content')
<div class="card card-default">
    <div class="card-header">{{ isset($post) ? 'Edit Post' : 'Create Post' }}</div>
    <div class="card-body">
        @include('partials.errors')
        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @if(isset($post))
            @method('PUT')
            @endif
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ isset($post) ? $post->title : '' }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="5" rows="5" class="form-control">
                    {{ isset($post) ? $post->description : '' }}
                </textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : '' }}">
                <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-group">
                <label for="published_at">Published At</label>
                <input type="text" class="form-control" id="published_at" name="published_at"
                    value="{{ isset($post) ? $post->published_at : '' }}">
            </div>
            @if(isset($post))
            <div class="form-group">
                <img src="{{ asset('/storage/'.$post->image) }}" alt="" style="width: 100%;">
            </div>
            @endif
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{-- カテゴリーオプションでselectedが必要なのはedit時だけ、create時は不要 --}}
                        {{-- @if(isset($post)) {{($category->id === $post->category_id) ? 'selected' : ''}} @endif> --}}
                        {{(isset($post) && $category->id === $post->category_id) ? 'selected' : ''}}
                        >
                        {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            @if($tags->count() >0)
            <div class="form-group">
                <label for="tags">Tag</label>
                <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                    @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ (isset($post) && $post->hasTag($tag->id)) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    {{ isset($post) ? 'Update Post' : 'Create Post' }}
                </button>
            </div>


        </form>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.0/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    flatpickr('#published_at', {
        enableTime: true,
        enableSeconds: true
    });

    $(document).ready(function () {
        $('.tags-selector').select2();
    });

</script>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.0/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
