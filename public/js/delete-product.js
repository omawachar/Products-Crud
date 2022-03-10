$(document).ready(function () {
    
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
                console.log("productID " + product_id);
                $.ajax({
                    type: "GET",
                    url: "{{ url('delete')  }}"+"/" + product_id,
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
    
    
        });
