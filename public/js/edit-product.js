$(document).ready(function () {
    
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
                            console.log(data);
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
                console.log("productID" + product_id);
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
        

});
