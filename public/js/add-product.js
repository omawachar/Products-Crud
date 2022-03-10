$(document).ready(function () {
    
        //add product
        $('#addForm').on('submit', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                // 
            });
            $.ajax({
                type: "POST",
                url: "{{ url('addProduct') }}",
                data: $('#addForm').serialize(),
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    clear();
                    $('#exampleModal').modal('hide');
                    alert(response.message);
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

        $('#exampleModal').on('hidden.bs.modal', function() {
            //Close Modal
            console.log("modal close");
            $('#category').val([]).change();
            clear();


        });

        function clear() {
            $("#inputCategory").val("");
            $("#image").val("");
            $("#category").val("");
            $("#subcategory").val("");

        }

    });