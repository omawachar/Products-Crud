<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- csrf token -->
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar navbar-dark bg-dark navbar-expand-lg navbar-light bg-light p-3 ml-1 mr-1">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active m-2">
                    <a class="nav-link  text-white" href="products">Products <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active m-2">
                    <a class="nav-link  text-white" href="categories"> Category <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active m-2">
                    <a class="nav-link  text-white" href="subcategories">Subcategory <span class="sr-only"></span></a>
                </li>

                @auth
                <li class="nav-item active">
                    <div class="nav-link navbar-brand pull-right">
                        <span class="text-xs font-bold uppercase">Welcome {{auth()->user()->name}}</span>
                        <form method="POST" action="/logout" class="text-xs font-semibold ">
                            @csrf
                            <button type="submit"> Log Out</button>
                        </form>
                    </div>
                </li>
                @else
                <li class="nav-item active ">
                    <a class="nav-link  text-white" href="/register">Register <span class="sr-only"></span></a>
                </li>
                <li>
                    <a href="/login" class="nav-link">Log in</a>
                </li>
                @endauth
            </ul>

        </div>
    </nav>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>


    <!-- jQuery -->
    <!-- <script src="//code.jquery.com/jquery.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('scripts')
</body>

</html>