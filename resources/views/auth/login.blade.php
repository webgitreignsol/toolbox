@extends('layouts.app')



<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-7">
                <div class="sidenav" style="background-image: url('{{ asset('/public/assets/admin/img/teen-driver.jpg') }}')!important; background-repeat: no-repeat; background-size: cover;">
                </div>
            </div>

            <div class="col-md-5">
                <div class="login-form justify-content-center" style="margin:auto;">
                    <h2 style="text-align: center; color: #fff;">Welcome Back!</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label style="color: #fff;">Email</label>
                            <input style="color: black;" id="email" type="email" class="input100 form-control @error('email') is-invalid @enderror" placeholder="Type Your Email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label style="color: #fff;">Password</label>
                            <input style="color: black;" id="password" type="password" class="input100 form-control @error('password') is-invalid @enderror" placeholder="Type Your Password" name="password" autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <button type="submit" class="login100-form-btn">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        font-family: "Lato", sans-serif;
    }
    .main-head{
        height: 150px;
        background: #FFF;

    }

    .sidenav {
        height: 100%;
        background-color: #000;
        overflow-x: hidden;
        padding-top: 20px;
    }
    .main {
        padding: 0px 10px;
    }

    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
    }

    @media screen and (max-width: 450px) {
        .login-form{
            margin-top: 10%;
        }

        .register-form{
            margin-top: 10%;
        }
    }

    /*@media screen and (min-width: 768px){*/
    .main{
        margin-left: 80%;
    }

    .sidenav{
        width: 60%;
        position: fixed;
        z-index: 9999999999;
        top: 0;
        left: 0;
    }

    .login-form{
        margin-top: 0%;
        width: 60%;
        margin-top: 160px !important;
        /*margin: 180px 0px 0px 180px;*/
    }

    .register-form{
        margin-top: 20%;
    }
    /*}*/
    .login-main-text{
        margin-top: 20%;
        padding: 60px;
        color: #000;
    }

    .login-main-text h2{
        font-weight: 300;
    }

    .btn-black{
        background-color: #0a568c !important;
        color: #fff !important;
        float: right;
    }
    .login100-form-btn {
        background-color: #0a568c !important;
        font-family: Poppins-Medium;
        font-size: 16px;
        color: #fff;
        line-height: 1.2;
        text-transform: uppercase;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 20px;
        width: 100%;
        height: 50px;
        border-radius: 10px;
    }

    .input100 {
        font-family: Poppins-Medium;
        font-size: 16px;
        color: #0000;
        line-height: 1.2;
        display: block;
        width: 100%;
        height: 55px;
        background: transparent;
        padding: 0 7px 0 43px;
    }
</style>
