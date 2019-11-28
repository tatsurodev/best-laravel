@extends('layouts.app')
@section('title') Single Todo: {{ $todo->name }}
@endsection

@section('content')
<div class="text-center my-5">
    {{ $todo->name }}
</div>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card card-default">
            <div class="card-header">Detail</div>
            <div class="card-body">
                {{ $todo->name }}
            </div>
        </div>
        <a href="/todos/{{$todo->id}}/edit" class="btn btn-info my-2">Edit</a>
        <a href="/todos/{{$todo->id}}/delete" class="btn btn-danger my-2">Delete</a>
    </div>
</div>
@endsection
