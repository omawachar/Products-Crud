<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />

    <style>
        form .error {
            color: #ff0000;
        }
    </style>
</head>

<body>

    <section class="intro">
        <div class="bg-image h-100" style="background-image: url('https://mdbootstrap.com/img/Photos/new-templates/search-box/img4.jpg');">
            <div class="mask d-flex align-items-center h-100" style="background-color: rgba(255,255,255,.6);">
                <div class="container ">
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                    @endforeach
                    @endif
                    <div class="row justify-content-center ">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card gradient-custom" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-white">

                                    <div class="my-md-5">
                                        <form method="POST" action="/" id="formLogin" autocomplete="off">
                                            @csrf
                                            <div class="text-center pt-1">
                                                <i class="fas fa-user-astronaut fa-3x"></i>
                                                <h1 class="fw-bold my-5 text-uppercase">log in</h1>
                                            </div>

                                            <div class="form-outline form-white mb-4">
                                                <input type="email" id="typeEmail" name="email" class="form-control form-control-lg" />
                                                <label class="form-label" for="typeEmail">Email</label>

                                            </div>

                                            <div class="form-outline form-white mb-4">
                                                <input type="password" id="typePassword" name="password" class="form-control form-control-lg" />
                                                <label class="form-label" for="typePassword">Password</label>
                                            </div>

                                            <!-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Remember me
                                            </label>
                                        </div> -->

                                            <div class="text-center py-5">
                                                <button class="btn btn-light btn-lg btn-rounded px-5" type="submit">Login</button>
                                                <a class="btn btn-dark btn-lg btn-rounded px-5" href="register">Register</a>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- <div class="text-center">
                                        <p class="mb-0"><a href="#!" class="text-white fw-bold">Forgot password?</a></p>
                                    </div> -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="/js/jquery-form-validation.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
</body>

</html>