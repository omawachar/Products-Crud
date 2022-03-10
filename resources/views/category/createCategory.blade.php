@extends('layout.app')

@section('content')

<div class="container">
    <h1 class="text-center mt-4"> Add Category </h1>
    <br>
    <br>
    <form action="createCategory" id="createCategory" method="POST" name="createCategory" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{auth()->user()->id}}">
        <div class="form-group mb-3">
            <label for="categoryname" class="form-label"> Category Name</label>
            <input type="text" class="form-control" name="category_name" id="inputCategory" placeholder="Add Category Name">
        </div>

        <div>
            <input type="submit" class="btn btn-primary" value="submit">
            <a href="/categories" class="btn btn-secondary">Cancel </a>
        </div>
    </form>
</div>
@endsection