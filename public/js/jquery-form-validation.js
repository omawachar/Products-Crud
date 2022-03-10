$(document).ready(function () {
    
    $("#createCategory,#update,#createSubcategory,#updateSubcategory,#formRegister,#formLogin").validate({
    
        rules: {
            category_name: "required",
            category_id: {
              required:true  
            },
            name: {
                required: true
            },
            email: {
                required:true
            },
             password: {
            required: true,
            minlength: 4
        },
        confirm_password: {
            required: true,
            minlength: 4,
            equalTo:"#inputPassword"
        }
          

        },
          messages: {
              category_name: "Please enter Category Name ",
              name: {
                  required:"subcategory name required"
              },
              email: {
                required: "This field is required1",  
                uniqueUserName:"email id already exixts"
            },
              category_id: {
                  required: "please select a category"
              },
               password: {
                required: "please provide a password",
                minlength:"your password must be at least 4 characters long"
            },
            confirm_password: {
                required: "please provide a password",
                minlength: "your password must be at least 4 characters long",
                equalTo:"Please enter the same password as above"
            },


            }
    });

});