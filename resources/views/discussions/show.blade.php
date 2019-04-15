@extends('layouts.app')

@section('content')
<div class="card">
    @include('partials.discussion-header')
    <div class="card-body">
        <div class="text-center">
            <strong>{!! $discussion->title !!}</strong>
        </div>
        <hr>
        {!! $discussion->content !!}
    </div>
</div>
@foreach($discussion->replies()->paginate(3) as $reply)
<div class="card my-5">
    <div class="card-header">
        <div class="d-flex justify-contet-between align-items-center">
            <div>
                <img class="rounded-cirecle" style="width: 40px; height: 40px;"
                src="{{ Gravatar::src($reply->owner->email) }}" alt="">
            <span>{{ $reply->owner->name }}</span>
        </div>
            <div>
                @if(auth()->user()->id === $discussion->user_id)
                <form
                    action="{{ route('discussions.best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id]) }}"
                    method="post">
                    @csrf
                    <button class="btn btn-primary btn-sm" type="submit">Mark as best reply</button>
                </form>

                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
        {!! $reply->content !!}
    </div>
</div>
@endforeach
{{ $discussion->replies()->paginate(3)->links() }}
<div class="card my-5">
    <div class="card-header">Add a reply</div>
    <div class="card-body">
        @auth
        <form action="{{ route('replies.store', $discussion->slug) }}" method="post">
            @csrf
            <input type="hidden" name="content" id="content">
            <trix-editor input="content"></trix-editor>
            <button class="btn btn-success btn-sm my-2">Add Reply</button>
        </form>
        @else
        <a href="{{ route('login') }}" class="btn btn-info text-white btn-block">Sign in to add reply</a>
        @endauth
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.0/trix.css">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.0/trix.js"></script>
@endsection
