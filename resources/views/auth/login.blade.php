@extends('layouts.app')

<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-4 text-center">
            <h1 class='text-white'>Welcome Back!</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
            <div class="form-login"></br>
                <h4>Toolbox 2U Login Form</h4>
                </br>
                <input type="text" id="email" name="email" class="form-control input-sm chat-input @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email"/>
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                </br></br>
                <input type="password" id="password" name="password" class="form-control input-sm chat-input @error('password') is-invalid @enderror" placeholder="Password"/>
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                </br></br>
                <div class="wrapper">
                        <span class="group-btn">
                            <button type="submit" class="btn btn-danger btn-md">login <i class="fa fa-sign-in"></i></button>
                        </span>
                </div>
            </div>
            </form>
        </div>
    </div>
    </br></br></br>
<style>
    /*author:starttemplate*/
    /*reference site : starttemplate.com*/
    body {
        background-image: url("{{ asset('public/assets/admin/img/login.jpg') }}");
        background-position:center;
        background-size:cover;

        -webkit-font-smoothing: antialiased;
        font: normal 14px Roboto,arial,sans-serif;
        font-family: 'Dancing Script', cursive!important;
    }

    .container {
        padding: 68px;
    }
    ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: #ffffff!important;
        opacity: 1; /* Firefox */
        font-size:18px!important;
    }
    .form-login {
        background-color: rgba(0,0,0,0.55);
        padding-top: 10px;
        padding-bottom: 20px;
        padding-left: 20px;
        padding-right: 20px;
        border-radius: 15px;
        border-color:#d2d2d2;
        border-width: 5px;
        color:white;
        box-shadow:0 1px 0 #cfcfcf;
    }
    .form-control{
        background:transparent!important;
        color:white!important;
        font-size: 18px!important;
    }
    h1{
        color:white!important;
    }
    h4 {
        border:0 solid #fff;
        border-bottom-width:1px;
        padding-bottom:10px;
        text-align: center;
    }

    .form-control {
        border-radius: 10px;
    }
    .text-white{
        color: white!important;
    }
    .wrapper {
        text-align: center;
    }
    .footer p{
        font-size: 18px;
    }
</style>