@extends('layouts.app')



    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-7">
            <div class="sidenav" style="background-image: url('{{ asset('/public/assets/admin/img/img.jpg') }}')!important; background-repeat: no-repeat; background-size: cover;">
            </div>
            </div>
         
                <div class="col-md-5">
                    <div class="login-form" style="margin-left: 20px;">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-black">Login</button>
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
                margin: 17rem;
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
            color: #fff;
            float: right;
        }
    </style>