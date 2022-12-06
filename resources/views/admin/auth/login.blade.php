@extends('layouts.app')

@section('content')
<style>
    .login-page {
        width: 360px;
        padding: 8% 0 0;
        margin: auto;
    }

    .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    .form input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #4CAF50;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }

    .form button:hover,
    .form button:active,
    .form button:focus {
        background: #43A047;
    }

    .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
    }

    .form .message a {
        color: #4CAF50;
        text-decoration: none;
    }

    .container {
        position: relative;
        z-index: 1;
        max-width: 300px;
        margin: 0 auto;
    }

    .container:before,
    .container:after {
        content: "";
        display: block;
        clear: both;
    }

    .container .info {
        margin: 50px auto;
        text-align: center;
    }

    .container .info h1 {
        margin: 0 0 15px;
        padding: 0;
        font-size: 36px;
        font-weight: 300;
        color: #1a1a1a;
    }

    .container .info span {
        color: #4d4d4d;
        font-size: 12px;
    }

    .container .info span a {
        color: #000000;
        text-decoration: none;
    }

    .container .info span .fa {
        color: #EF3B3A;
    }

    body {
        background: #76b852;
        /* fallback for old browsers */
        background: rgb(141, 194, 111);
        background: linear-gradient(90deg, rgba(141, 194, 111, 1) 0%, #b3b3b3 50%);
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
</style>


<div class="login-page">
    @if(\Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="alert-body">
            {{ \Session::get('success') }}
        </div>
    </div>
    @endif
    {{ \Session::forget('success') }}
    @if(\Session::get('error'))
    <div class="alert alert-danger fade show" role="alert">
        <div class="alert-body">
            {{ \Session::get('error') }}
        </div>
    </div>
    @endif
    <div class="form">
        <form class="auth-login-form mt-2" action="{{route('adminLoginPost')}}" method="post">
            <h3 style=" text-align: center">
               Admin Login
            </h3>
            <img style="text-align: center; margin-bottom: 10%;" src="../assets/logo.png" width="45%" alt="">
            @csrf
            <div class="mb-1">
                <input required type="text" class="form-control" id="email" name="email" placeholder="Email" autofocus />
                @if ($errors->has('email'))
                <span class="help-block font-red-mint">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="mb-1">

                <input required type="password" id="password" placeholder="password" name="password" tabindex="1" />

                @if ($errors->has('password'))
                <span class="help-block font-red-mint">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            <button type="submit">Login</button>
        </form>

    </div>
</div>
@endsection