@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h3>{{ Auth::user()->name }}</h3>
        <h3><a href="/logout">Logout</a></h3>
    </div>

    <div class="container text-center">
        <div style="font-size:clamp(0rem, 1rem + 7vw, 15rem)">
            User Authentication System
        </div>
    </div>
@endsection
