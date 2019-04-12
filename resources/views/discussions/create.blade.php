@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Add Discussion</div>

    <div class="card-body">
        <form action="{{ route('discussion.store') }}" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" class="form-control" id="content" cols="5" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="chennel">Channel</label>
                <select name="channel" class="form-control" id="channel">
                    @foreach ($channels as $channel)
                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-success" type="submit">Create Discussion</button>
        </form>
    </div>
</div>
@endsection
