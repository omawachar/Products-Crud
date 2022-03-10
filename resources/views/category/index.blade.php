@extends('layout.app')

@section('content')

<div class="container mt-1 pl-5 pr-5 pb-5 border">
    <h1 class="text-center">Categories</h1>
    <br>
    <!-- <div>
          
            <div class="float-end">
                <div>
                    <a class="btn btn-primary " href="createCategory">Add Category</a>
                    <a class="btn btn-primary " href="subcategories">Show Subcategories</a>
                    <a class="btn btn-primary " href="product">Products</a>
                </div>
            </div>
        </div> -->
    <div class="float-end">
        <div>
            <a class="btn btn-primary " href="createCategory">Add Categories</a>
            <!-- <a href="/categories" class="btn btn-primary">Categories </a> -->
        </div>
    </div>
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <table id="datatable" class="table ">
                            <thead>
                                <th>SNo.</th>
                                <th>Category</th>
                                <th>Products</th>
                                <th>Action</t h>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->category_name}}</td>
                                    <td>
                                        @foreach($category->products as $product)
                                        {{ $product->name ?? '' }}@if (!$loop->last) , @endif


                                        @endforeach
                                    </td>
                                    <td><a href="edit/{{$category->id}}">Edit</a> <a onclick="confirmDelete('this')" href="">Delete</a></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>
    <script type="text/javascript">
        $('#datatable').DataTable({})
    </script>
    <script>
        function confirmDelete() {
            let text = "Are you sure you want to delete this Category ?";
            if (confirm(text) == true) {
                location.href = "delete/this.id";
            } else {
                location.href = "/";
            }
        }
    </script>

    @endsection