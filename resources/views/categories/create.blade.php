@extends('layouts.app')
@section('content')
<div class="card card-default">
    <div class="card-header">
        Create Category
    </div>
    <div class="card-body">
        <form action="{{ route('categories.store') }}" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
                <button class="btn btn-success">Add Category</button>
            </div>
        </form>
    </div>
</div>
@endsection
