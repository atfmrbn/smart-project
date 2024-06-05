<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ $title }}</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/flags/flags.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        .login-body {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .login-card {
            max-width: 600px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: row;
        }
        .login-left {
            padding: 20px;
            background-color: #007bff;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-right {
            padding: 40px;
            background-color: #fff;
            flex: 2;
        }
        .login-right-wrap {
            margin: auto;
        }
        .login-right-wrap h1,
        .login-right-wrap h2 {
            text-align: center;
            font-size: 22px; /* Updated font size */
            margin-bottom: 20px; /* Added margin for spacing */
        }
        .form-group.position-relative {
            margin-bottom: 20px;
        }
        .form-group.position-relative .profile-views,
        .form-group.position-relative .toggle-password {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 10px;
            cursor: pointer;
        }
        .toggle-password:hover {
            color: #007bff;
        }
        .forgotpass {
            margin-top: 10px;
        }
        .forgotpass .remember-me {
            margin-bottom: 0;
        }
        .login-or {
            text-align: center;
            margin: 20px 0;
        }
        .login-or .or-line {
            display: block;
            height: 1px;
            background-color: #e9ecef;
            margin: 0 30px;
            position: relative;
            top: -10px;
        }
        .login-or .span-or {
            background-color: #fff;
            padding: 0 10px;
            position: relative;
            z-index: 1;
        }
        .social-login {
            text-align: center;
        }
        .social-login a {
            margin: 0 5px;
            font-size: 18px;
            color: #495057;
        }
        .social-login a:hover {
            color: #007bff;
        }
        .login-left img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <div class="main-wrapper login-body">
        <div class="login-card">
            <div class="login-left">
                <img class="img-fluid" src="{{ asset('assets/img/login.png') }}" alt="Logo">
            </div>
            <div class="login-right">
                <div class="login-right-wrap">
                    <h1>Selamat Datang di SMARTS</h1>
                    <h2>{{ $title }}</h2>

                    @if (session()->has('errorMessage'))
                        <div class="alert alert-danger">
                            {{ session('errorMessage') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ URL::to('/login') }}" autocomplete="off">
                        @csrf
                        <div class="form-group position-relative">
                            <label>Username <span class="login-danger">*</span></label>
                            <input type="text" id="username" name="username"
                                class="form-control @error('username') is-invalid @enderror"
                                placeholder="Enter username">
                            <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group position-relative">
                            <label>Password <span class="login-danger">*</span></label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter password">
                            <span class="profile-views feather-eye toggle-password"></span>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="forgotpass d-flex justify-content-between align-items-center">
                            <div class="remember-me">
                                <label class="custom_check mb-0 d-inline-flex"> Remember me
                                    <input type="checkbox" name="remember">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <a href="{{ URL::to('forgot-password') }}">Forgot Password?</a>
                        </div>
                        <div class="form-group mt-4">
                            <button class="btn btn-primary btn-block" type="submit">Login</button>
                        </div>
                    </form>

                    <div class="login-or">
                        <span class="or-line"></span>
                        <span class="span-or">or</span>
                    </div>

                    <div class="social-login">
                        <a href="#"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>
</html>