<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #17a2b8;
            height: 100vh;
        }

        #login .container #login-row #login-column #login-box {
            margin-top: 50px;
            max-width: 600px;
            /* height: 340px; */
            border: 1px solid #9C9C9C;
            background-color: #EAEAEA;
        }

        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
        }
    </style>
    <title>Digisign</title>
</head>

<body>
    <div id="login">
        <!-- <h3 class="text-center text-white pt-5">Login form</h3> -->

        <div class="container">
            <div class="row justify-content-center mt-3">
                <div class="col-lg-4 col-sm-2 text-center">
                    <img src="images/icon2.png" id="icon" alt="User Icon" class="img-fluid"
                        style="max-width:50%; height:auto" />
                </div>
            </div>
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" method="POST" action="{{ url('/login') }}">
                            @csrf
                            <h3 class="text-center text-info">Login</h3>
                            @if (\Session::has('alert'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert"
                                    id="myAlert" width="50%">
                                    {{ Session::get('alert') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="username" class="text-info">Email:</label><br>
                                <div class="input-group mb-3">
                                    <input type="text" name="email" id="username" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" required class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                        </form>
                        <div class="row mb-3">
                            <div class="col-sm text-right">
                                <small>v.1.0.1</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
