@extends('layout.app')

@section('content')



<div class="container  py-3">
    <div class="row">
        <div class="col-md-12">
            <div id="success_message"></div>
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">
                        Products
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Product</button>
                    </h2>
                </div>

                <div class="card-body">
                    <table id="myTable" class="cell-border table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Created At</th>
                                <th>updated At</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- <a class="btn btn-primary" href="addProduct"> Add Product</a> -->

</div>
<!--add student data modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="company_id" name="user_id" value="{{auth()->user()->id}}">
                    <div class="form-group mb-3">
                        <label for="productName" class="form-label"> Product Name</label>
                        <input type="text" class="form-control" name="name" id="inputCategory" placeholder="Add Product Name">
                    </div>
                    <div class="form-group mb-3">
                        <label>Profile Image</label>
                        <div class="mb-3">
                            <img id="preview-image-before-upload" class="rounded img-thumbnail form-control mb-1" alt="preview image" style="max-height: 100px; max-width: 100px; ">
                            <input type="file" name="image" class="form-control" id="image" placeholder="image">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2" for="">Choose Category</label>
                        <select class="form-control " style="width: 100%;" name="category_id" id="category">
                            <option></option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2" for="">Choose Subcategory</label>
                        <select name="subcategory[]" id="subcategory" style="width: 100%;" multiple="multiple" class="form-control ">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="" id="checkBoxProduct" checked>
                        <label class="form-check-label" for="flexCheckDefault">
                            Product Active
                        </label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add student data modal -->


<!--Edit student data modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit and Update Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <input type="hidden" id="edit_product_id" name="id">
                    <div class="form-group mb-3">
                        <label for="productName" class="form-label"> Product Name</label>
                        <input type="text" class="form-control" name="name" id="edit_name" placeholder="Add Product Name">
                    </div>
                    <div class="form-group mb-3">
                        <label>Profile Image</label>
                        <div class="mb-3">
                            <img id="preview-image-before-upload-edit" class="rounded img-thumbnail form-control mb-1" alt="preview image" style="max-height: 100px; max-width: 100px; ">
                            <input type="file" name="image" class="form-control" id="edit_image" placeholder="image">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Choose Category</label>
                        <select class="form-control mb-2" name="category_id" id="edit_category">
                            <option value=""></option>

                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2" for="">Choose Subcategory</label>
                        <select name="subcategory[]" id="edit_subcategory" style="width: 100%;" multiple="multiple" class="form-control ">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="" id="edit_chkBox" checked>
                        <label class="form-check-label" for="flexCheckDefault">
                            Product Active
                        </label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class=" update_product btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Edit student data modal -->


<!-- delete modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteForm" enctype="multipart/form-data">

                <div class="modal-body">
                    <input type="hidden" id="delete_product_id">
                    <h4>Are you sure ? Want to delete this product ? </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="delete_product btn btn-primary">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end delte product data modal -->


<!-- add remove variant Modal -->
<div class="modal fade" id="add-remove-variant-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Variant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form id="add-remove-variant-form" action="{{ url('add-remove-variant') }}" method="POST">
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

                    <!-- <input type="text" name="product_id" id="product_id1"> -->
                    <table class="table table-bordered" id="dynamicAddRemoveTable">
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th></th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td><input type="text" id="name" name="moreFields[0][name]" placeholder="Enter title" class="form-control" /></td>
                            <td><input type="text" id="price" name="moreFields[0][price]" placeholder="Enter price" class="form-control" /></td>
                            <td><input type="hidden" name="moreFields[0][product_id]" id="product_id" class="form-control" /></td>
                            <td><button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button></td>
                        </tr>
                    </table>
                    <!-- <button type="submit" class="btn btn-success">Save</button> -->
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add variant</button>
                </form>

            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Add variant</button> -->
            </div>

        </div>
    </div>
</div>
<!-- end add remove variant modal -->

<!-- Modal -->
<div class="modal fade" id="showVariantModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="product_variant_title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <input type="text" name="product_id" id="product_id1"> -->
                <table class="table table-bordered" id="showAllVariantsTable">

                    <tbody>
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')


<script type="text/javascript">
    $(document).ready(function() {
        clear();
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            order: [
                [0, 'dsc']
            ],
            ajax: "{!! route('get.products') !!}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#category').select2({
            placeholder: "Select Category",

            dropdownParent: $('#exampleModal'),
            dropdownPosition: 'below'
        }).on('change', function(e) {
            var cat_id = e.target.value;
            //    console.log(cat_id)
            $.ajax({
                url: "{{ url('getSubCat') }}",
                type: "POST",
                data: {
                    cat_id: cat_id
                },
                success: function(data) {
                    // console.log(data);
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
            placeholder: 'Select subcategory',
            dropdownParent: $('#exampleModal'),

        });

        $('#image').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image-before-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });


        //add product
        $('#addForm').on('submit', function(e) {
            e.preventDefault();
            var img_data = $('#image').get(0).files[0];
            formdata = new FormData(this);
            formdata.append("image", img_data);
            $.ajax({
                type: "POST",
                url: "{{ url('addProduct') }}",
                data: formdata,
                dataType: "json",
                // enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {

                    if (response.status == 200) {
                        alert(response.message);
                        $('#exampleModal').modal('hide');
                        clear();
                        console.log(response);
                        var oTable = $('#myTable').DataTable();
                        oTable.ajax.reload();
                    } else {

                        $('#exampleModal').modal('hide');
                        console.log(response.message);
                    }

                    // to reload


                },
                error: function(error) {
                    console.log(error);
                    alert("Data not Saved");
                },

            });
        })


        $('#exampleModal').on('hidden.bs.modal', function() {
            //Close Modal
            //  console.log("modal close");
            $('#category').val([]).change();
            clear();


        });

        function clear() {
            $("#inputCategory").val("");
            $("#image").val("");
            $("#category").val("");
            $("#subcategory").val("");

        }



        // <!-- editmodal -->

        $('body').on('click', '#getEditProductData', function(e) {
            var id = $(this).data('id');

            $('#editProductModal').modal('show');

            $('#editCategory').select2({
                placeholder: 'Select Category',
                dropdownParent: $('#editProductModal'),
            });

            $.ajax({
                url: "editProduct/" + id,
                method: 'GET',
                success: function(response) {
                    console.log(response);

                    if (response == 404) {
                        $('#success_message').html("");
                        $('#success_message').addClass('aler aler-danger');
                        $('#success_message').text(response.message);
                    } else {
                        $('#edit_name').val(response.product.name);
                        console.log(response.product.image)
                        $('#preview-image-before-upload-edit').attr('src', response.product.image);
                        //            $('#edit_image').val(response.product.name);
                        $('#edit_product_id').val(response.product.id);
                        $('#edit_category').empty();
                        var product_catgory = response.product.category_id;
                        console.log(product_catgory);
                        $('#edit_category').empty();
                        $.each(response.categories, function(i, value) {
                            if (value.id == product_catgory) {
                                $('#edit_category').append(
                                    `<option value="${value.id}" selected > ${value.category_name} </option>`
                                );
                            } else {
                                $('#edit_category').append(
                                    `<option value="${value.id}"  > ${value.category_name} </option>`
                                );
                            }
                        });

                        //subcategory select2
                        $('#edit_subcategory').empty();
                        var product_subcatCatgory = [];
                        $.each(response.product.subcategories, function(index, value) {

                            product_subcatCatgory[index++] = value.id;
                        });
                        console.log(product_subcatCatgory);
                        $('#edit_subcategory').empty();
                        $.each(response.subs, function(i, value) {
                            var subid = value.id;
                            if (jQuery.inArray(subid, product_subcatCatgory) != -1) {
                                $('#edit_subcategory').append(
                                    `<option value="${value.id}" selected > ${value.name} </option>`
                                );
                            } else {

                            }
                        });

                    } //end of category

                } //end of ajax succss
            }); //end of ajax call

            // category onchange
            $('#edit_category').select2({
                placeholder: 'Select Category',
                dropdownParent: $('#editProductModal'),
            }).on('change', function category(e) {
                var cat_id = e.target.value;
                console.log(cat_id);
                $.ajax({
                    url: "{{ url('getSubCat') }}",
                    type: "POST",

                    data: {
                        cat_id: cat_id
                    },
                    success: function(data) {
                        $('#edit_subcategory').empty();
                        if (data.subcategories[0].subcategories.length === 0) {
                            $('#edit_subcategory').append('<option value="">' + 'No Subcategory found ' + '</option>');
                        } else {
                            //  console.log(data);
                            $.each(data.subcategories[0].subcategories, function(index, subcategory) {
                                $('#edit_subcategory').append(
                                    `<option value="${subcategory.id}"  > ${subcategory.name} </option>`
                                );
                            });
                        }
                    }
                })
            });
            $('#edit_subcategory').select2({
                placeholder: 'Select subcategory',
                multiple: true,
                dropdownParent: $('#editProductModal'),
            });

            //update button click
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                var product_id = $('#edit_product_id').val();
                //      console.log("productID" + product_id);
                $.ajax({
                    type: "POST",
                    url: "{{ url('updateProduct') }}",
                    data: $('#editForm').serialize(),
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        clear();
                        alert(response.message);
                        $('#editProductModal').modal('hide');
                        var oTable = $('#myTable').DataTable();
                        // to reload
                        oTable.ajax.reload();

                    },
                    error: function(error) {
                        console.log(error);
                        alert("Data not Saved");
                    }
                });
            })

        });


        // delete product
        $('body').on('click', '#getDeleteProduct', function(e) {
            e.preventDefault();
            var product_delete_id = $(this).data('id');
            //    alert(product_delete_id);
            $('#deleteProductModal').modal('show');
            $('#delete_product_id').val(product_delete_id);

            //   var url = "/delete/" + product_id;
            $('#deleteForm').on('submit', function(e) {
                e.preventDefault();
                var product_id = $('#delete_product_id').val();
                //   console.log("productID " + product_id);
                $.ajax({
                    type: "GET",
                    url: "{{ url('delete')  }}" + "/" + product_id,
                    data: $('#deleteForm').serialize(),

                    success: function(response) {
                        $('#deleteProductModal').modal('hide');
                        alert(response.message);
                        var oTable = $('#myTable').DataTable();
                        // to reload
                        oTable.ajax.reload();

                    }

                });
            });
        });
        // add-remove-varaint modal
        $('body').on('click', '#btnAddVariant', function(e) {
            e.preventDefault();
            var product_id = $(this).data('id');
            // alert(product_id);
            $('#add-remove-variant-modal').modal('show');
            $('#product_id').val(product_id);

            $('#add-remove-variant-form').on('submit', function(e) {

                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: "{{ url('add-remove-variant') }}",
                    data: $('#add-remove-variant-form').serialize(),
                    dataType: "json",
                    success: function(response) {

                        console.log(response);


                    }
                });
            });

            var i = 0;
            $("#add-btn").click(function() {
                ++i;
                $("#dynamicAddRemoveTable").append('<tr><td><input type="text" name="moreFields[' + i + '][name]" placeholder="Enter title" class="form-control" /></td><td><input type="text" name="moreFields[' + i + '][price]" placeholder="Enter price" class="form-control" /></td><td><input type="hidden" name="moreFields[' + i + '][product_id]" value="' + product_id + '" id="product_id" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
            });
            $(document).on('click', '.remove-tr', function() {
                $(this).parents('tr').remove();
            }); //end of add-remove-varaint modal
            $('#add-remove-variant-model').on('hidden.bs.modal', function() {
                //Close Modal
                $(this).parents('tr').remove();
                //   console.log("modal close");
                $('#name').val([]).change();
                $('#price').val([]).change();
                $('#product_id').val([]).change();



            });

        }); //end of add-remove-varaint modal


        $('body').on('click', '#getShowVariants', function(e) {
            e.preventDefault();
            var tableHeadingRemoced;
            var product_id = $(this).data('id');
            console.log("ajax product id " + product_id);


            $.ajax({
                url: "getProductsVariant/" + product_id,
                method: 'GET',
                success: function(response) {

                    if (response.status == 1) {

                        $('#showVariantModal').modal('show');

                        $('#product_variant_title').text(`Product Id ${product_id}`);
                        console.log(response.variants);
                        console.log(response.variants.length);
                        $("#showAllVariantsTable").append(
                            `<tr>
                        <th>Sr No</th>
                        <th>Name</th>
                        <th>Price</th>

                    </tr>`
                        );
                        for ($i = 0; $i < response.variants.length; $i++) {

                            $("#showAllVariantsTable").append(`<tr>
                               <td><input type="text" value="${$i+1}" placeholder="Id" class="form-control" /></td>
                            <td><input type="text" value="${response.variants[$i].name}" placeholder="title" class="form-control" /></td>
                             <td><input type="text" value="${response.variants[$i].price}" placeholder="Price" class="form-control" /></td>

                            </tr>`);
                        }
                    } else {
                        alert(response.message)
                    }
                }
            });


            $('#showVariantModal').on('hidden.bs.modal', function() {
                $("#showAllVariantsTable > tbody").empty();
                tableHeadingRemoced = true;

                console.log('modal close');
                // $(this).find('#showAllVariantsTable').trigger('reset');
            })

            if (tableHeadingRemoced) {
                console.log('xxxx');

            }
        });

    }); //end of document.ready
</script>


@endsection