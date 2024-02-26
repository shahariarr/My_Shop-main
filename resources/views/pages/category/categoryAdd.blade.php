@extends('layouts.app')

@section('content')

<div class="card mt-5 mb-3">
    <div class="card-header">
        Add Category
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('category.store') }}">
            @csrf
            <div class="mb-3">
                <label for="category" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    </div>
</div>

@endsection
