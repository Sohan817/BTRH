@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-4 offset-md-4">
                <div class="card form-holder">
                    <div class="card-body">
                        <h1>Login</h1>

                        @if (Session::has('error'))
                            <p class="text-danger">{{ Session::get('error') }}</p>
                        @endif
                        @if (Session::has('success'))
                            <p class="text-success">{{ Session::get('success') }}</p>
                        @endif
                        @php
                            if (@isset($_COOKIE['email']) && @isset($_COOKIE['password'])) {
                                $email = $_COOKIE['email'];
                                $password = $_COOKIE['password'];
                                $is_remember = "checke='checke'";
                            } else {
                                $email = '';
                                $password = '';
                                $is_remember = '';
                            }
                        @endphp

                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    value="{{ $email }}" />
                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    value="{{ $password }}" />
                                @if ($errors->has('password'))
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="container">
                                <input type="checkbox" name="remember" class="mr-2" id="remember" {{ $is_remember }}>
                                <label for="remember">Remember me</label>
                                <div class="col-3 text-right my-3">
                                    <input type="submit" class="btn btn-primary" value=" Login " />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
