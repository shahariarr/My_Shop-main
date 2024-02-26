@extends('layouts.app')

@section('content')

<div class="card mt-5 mb-3">
    <div class="card-header">
        Category Update
    </div>
    <div class="card-body">
        <form action="{{route('category.update',$category->id)}}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="category" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="category" name="category" required value="{{old('category',$category->name)}}">
            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    </div>
</div>

@endsection
