@extends('layout.app')

@section('content')


<h1>Add Product</h1>
@if (count($errors) > 0)
@foreach ($errors->all() as $error)
<p class="alert alert-danger">{{ $error }}</p>
@endforeach
@endif
<div class="container">
    <form action="addProduct" id="createProduct" method="POST" name="createProduct" autocomplete="off" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="productName" class="form-label"> Product Name</label>
            <input type="text" class="form-control" name="name" id="inputCategory" placeholder="Add Product Name">
        </div>

        <div class="form-group mb-3">
            <label for="productName" class="form-label"> Product Name</label>
            <input type="text" class="form-control" name="user_id" value="{{auth()->id()}}" id="user_id" placeholder="chgcg">
        </div>


        <div class="form-group mb-3">
            <label>Profile Image</label>
            <div class="mb-3">
                <img id="preview-image-before-upload" class="rounded img-thumbnail form-control mb-1" alt="preview image" style="max-height: 100px; max-width: 100px; ">
                <input type="file" name="image" class="form-control" id="image" placeholder="image">
            </div>
        </div>


        <div class="form-group mb-3">
            <label for="">Choose Category</label>
            <select class="form-control mb-2" name="category_id" id="category">
                <option value="">Select</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Choose Subcategory</label>
            <select name="subcategory[]" id="subcategory" multiple="multiple" class="form-control mt-2">
                <option value=""></option>
            </select>
        </div>
        <br><br>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" value="" id="checkBoxProduct" checked>
            <label class="form-check-label" for="flexCheckDefault">
                Product Active
            </label>
        </div>

        <br>
        <div>
            <input type="submit" class="btn btn-primary" value="submit">
            <a href="/product" class="btn btn-secondary">Cancel </a>
        </div>
    </form>

</div>

@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#category').select2({
            placeholder: 'Select Category'
        }).on('change', function(e) {
            var cat_id = e.target.value;
            $.ajax({
                url: "{{ url('getSubCat') }}",
                type: "POST",
                data: {
                    cat_id: cat_id
                },
                success: function(data) {
                    $('#subcategory').empty();
                    if (data.subcategories[0].subcategories.length === 0) {
                        $('#subcategory').append('<option value="">' + 'No Subcategory found ' + '</option>');
                    } else {
                        $.each(data.subcategories[0].subcategories, function(index, subcategory) {
                            $('#subcategory').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                        })
                    }
                }
            })
        });
        $('#subcategory').select2({
            placeholder: 'Select subcategory'
        });
    });

    $('#image').change(function() {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-image-before-upload').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
</script>




</script>
@endsection