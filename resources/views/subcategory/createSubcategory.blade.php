@extends('layout.app')

@section('content')

<div class="container">
    <h1 class="text-center mt-4"> Add Subcategory </h1>
    <br>
    <br>
    <div>
        @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
        <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
        @endif
    </div>
    <form action="{{url('createSubcategory')}}" id="createSubcategory" method="POST" name="createSubcategory" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div>
            <input type="hidden" class="form-control" name="user_id" value="{{auth()->user()->id}}" id="user_id">
        </div>

        <div class="form-group mb-3">
            <label for="category_id" class="form-label"> Category Name</label>
            <select class="form-select" aria-label="Default select example" name="category_id" id="category_id">
                <option selected disabled>Select Category</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="inputSubcategory" class="form-label"> Subategory Name</label>
            <input type="text" class="form-control" name="name" id="inputSubcategory" placeholder="Add Subcategory Name">
        </div>

        <div>
            <input type="submit" class="btn btn-primary" value="submit">
            <a href="/subcategories" class="btn btn-secondary">Cancel </a>
        </div>
    </form>
</div>

@endsection