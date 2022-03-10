<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Update Subcategory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="/js/jquery-form-validation.js"></script>
    <style>
        form .error {
            color: #ff0000;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-4"> Update Subcategory </h1>
        <br>
        <br>
        <form action="{{url('updateSubcategory')}}" id="updateSubcategory" method="POST" name="updateSubcategory" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$subCategory->id}}">
            <div class="form-group mb-3">
                <label for="category_id" class="form-label"> Category Name</label>
                <select class="form-select" aria-label="Default select example" name="category_id" id="category_id">
                    <option selected disabled>Select Category</option>
                    @foreach($categories as $category)

                    <option value="{{$category->id}}" @if($subCategory->category_id ==$category->id )
                        selected
                        @endif
                        >{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="inputSubcategory" class="form-label"> Subategory Name</label>
                <input type="text" class="form-control" name="name" id="inputSubcategory" placeholder="Add Subcategory Name" value="{{$subCategory->name}}">
            </div>

            <div>
                <input type="submit" class="btn btn-primary" value="submit">
                <a href="/subcategories" class="btn btn-secondary">Cancel </a>
            </div>
        </form>
    </div>
</body>

</html>