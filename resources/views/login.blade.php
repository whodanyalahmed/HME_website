@extends('layout')
@section('title')
    Log in | HME
@endsection

@section('content') 

<x-navbar/>
<div class="registration-form">
    <form action="/dashboard" method="POST">
        @csrf
        <h1 class="text-center mb-4">Login for students</h1>
        <div class="form-icon">
            <span><i class="far fa-user"></i></span>
        </div>
    <div class="form-group">
        <input type="text" class="form-control item" id="email" name="email" placeholder="Email">
    </div>
    <div class="form-group">
        <input type="password" class="form-control item" id="password" name="password"placeholder="Password">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-block create-account">Log in</button>
    </div>
</form>

</div>

@endsection