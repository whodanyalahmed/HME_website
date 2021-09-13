@extends('layout')
@section('title')
    Log in | Students
@endsection

@section('content') 

<x-navbar/>
@if (session('new'))
<div class="alert alert-success d-flex align-items-center container" role="alert" style="margin-top:100px;">
        <i class="fas fa-check-circle"></i>&nbsp;
        <div>
        {{session('new')}} has been added.
        </div>
    </div>
    
@endif
@if (session('disable'))
<div class="alert alert-danger d-flex align-items-center container" role="alert" style="margin-top:100px;">
        <i class="fas fa-exclamation-circle fs-3 mr-3"></i>&nbsp;
        <div>
        <strong>{{session('disable')}}</strong> has been disabled by admin.<br>
        Please contact to coaching for activation
        </div>
    </div>
    
@endif
@if (session('wrongId'))
<div class="alert alert-warning d-flex align-items-center container" role="alert" style="margin-top:100px;">
        <i class="fas fa-exclamation-circle fs-3 mr-3"></i>&nbsp;
        <div>
        {{session('wrongId')}}<br>
        </div>
    </div>
    
@endif
<div class="container">

    <div class="row">
        <div class="col-lg-6 text-center " style="margin-top: 100px;">
            <h2 class="display-4 float-start">Login</h2>
            <img class="d-lg-block d-xl-block d-none " src="/assets/img/auth.svg" alt="authentication" height="500px" width="500px">
        </div>
        <div class="col-lg-6 col-md-12 d-flex justify-content-center justify-content-lg-start">
            <div class="registration-form mt-5 float-start " id="login">
                <form action="/students/dashboard" class="shadow rounded" method="POST">
                    @csrf
                    <h1 class="text-center mb-4 ">Login for students</h1>
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
        </div>
    </div>

</div>

@endsection