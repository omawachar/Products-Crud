@extends('layout.app')

@section('content')

<div class="container mt-1 pl-5 pr-5 pb-5 border">
    <h1 class="text-center">Categories With Subcategories</h1>
    <br>
    <div>
        @if(session()->has('message'))
        <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        <div class="float-end">
            <div>
                <a class="btn btn-primary " href="createSubcategory">Add Subcategory</a>
                <a href="/categories" class="btn btn-primary">Categories </a>
            </div>
        </div>
    </div><br>
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <table id="datatable" class="table ">
                            <thead>
                                <th>Sr No.</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Subcat Product count</th>
                                <th>Action</t h>
                            </thead>
                            <tbody>
                                @foreach($subcategories as $subcategory)
                                <tr>
                                    <td>{{$subcategory->id}}</td>
                                    <td>{{$subcategory->category->category_name}}</td>
                                    <td>{{$subcategory->name}}</td>
                                    <td>{{$subcategory->products_count}}</td>
                                    <td><a href="editSubcategory/{{$subcategory->id}}">Edit</a> <a onclick="confirmDelete('this')" href="">Delete</a></td>

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
            let text = "Are you sure you want to delete this subcategory ?";
            if (confirm(text) == true) {
                location.href = "subcategory/delete/this.id";
            } else {
                location.href = "subcategories";

            }
        }
    </script>

    @endsection