@extends('layouts.app')
@section('content')
<form action="/store-todos" method="POST">
    @csrf
    <h1 class="text-center my-5">Create Todos</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Create new todo</div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                            <li class="list-group-item">
                                {{ $error }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        <input type="text" name="name" id="" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <textarea name="description" placeholder="Description" id="" cols="5" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group text-center"><button type="submit" class="btn btn-success">Create Todo</button></div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
