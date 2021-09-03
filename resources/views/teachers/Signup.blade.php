@extends('layout')

@section('title')
    Sign up | teachers
@endsection

@section('content')
<x-navbar/>
<div class="registration-form mt-5">
    <form action="signup" method="POST" >
        @csrf
        <h1 class="text-center mb-4">Signup for teachers</h1>
        <div class="form-icon bg-success">
            <span><i class="far fa-user"></i></span>
        </div>
    <div class="row">
    <div class="form-group col">
        <input type="text" class="form-control item" id="username" name="name" placeholder="Username" required>
    </div>
    <div class="form-group col">
        <input type="password" class="form-control item" id="password" name="password" placeholder="Password" required>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-8">
        <input type="email" class="form-control item" id="email" placeholder="Email" name="email" required>
    </div>
    <div class="form-group col-md-4">
        <input type="text" class="form-control item" id="phone-number" name="number" placeholder="Whatsapp Number" required>
    </div>
  </div>
    
  <div class="row">
    <div class="form-group col-md-6">
        <input type="time" class="form-control item" id="s_time" placeholder="Starting Time" name="s_time" required>
    </div>
    <div class="form-group col-md-6">
        <input type="time" class="form-control item" id="e_time" name="e_time" placeholder="Ending Time" required>
    </div>
  </div>
    
    <div class="row">
        <div class="col form-group">
            <button type="submit" style="    border-radius: 30px;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            color: white;
            margin-top: 20px;" class="btn btn-block btn-success">Create Account</button>
        </div>
        <div class="col mt-4"><a href="login">Already have an account?</a></div>
    </div>
</form>

</div>

@endsection