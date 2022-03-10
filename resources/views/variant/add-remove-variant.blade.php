@extends('layout.app')

@section('content')

<!-- //write main conmtent here -->
<div class="container">
    <div class="card mt-3">
        <div class="card-header">
            <h2>Add/remove variant</h2>
        </div>
        <div class="card-body">
            <form action="{{ url('add-remove-variant') }}" method="POST">
                @csrf
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (Session::has('success'))
                <div class="alert alert-success text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('success') }}</p>
                </div>
                @endif
                <input type="text" value="{{$product_id}}">
                <table class="table table-bordered" id="dynamicAddRemove">
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="moreFields[0][name]" placeholder="Enter title" class="form-control" /></td>
                        <td><input type="text" name="moreFields[0][price]" placeholder="Enter price" class="form-control" /></td>
                        <td><button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button></td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<!-- //write scripts here -->

<script type="text/javascript">
    var i = 0;
    $("#add-btn").click(function() {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="moreFields[' + i + '][title]" placeholder="Enter title" class="form-control" /></td><td><input type="text" name="moreFields[' + i + '][price]" placeholder="Enter price" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });
    $(document).on('click', '.remove-tr', function() {
        $(this).parents('tr').remove();
    });
</script>




@endsection