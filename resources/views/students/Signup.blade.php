@extends('layout')

@section('title')
    Sign up | Students
@endsection

@section('content')

<div class="registration-form">
    <form action="signup" method="POST" >
        <h1 class="text-center mb-4">Sign-Up for students</h1>
        <div class="form-icon">
            <span><i class="far fa-user"></i></span>
        </div>
    <div class="form-group">
        <input type="text" class="form-control item" id="username" placeholder="Username">
    </div>
    <div class="form-group">
        <input type="password" class="form-control item" id="password" placeholder="Password">
    </div>
    <div class="form-group">
        <input type="text" class="form-control item" id="email" placeholder="Email">
    </div>
    <div class="form-group">
        <input type="text" class="form-control item" id="phone-number" placeholder="Phone Number">
    </div>
    
    <div class="form-group">
        <button type="button" class="btn btn-block create-account">Create Account</button>
    </div>
</form>

</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
  $('#birth-date').mask('00/00/0000');
  $('#phone-number').mask('0000-0000');
 })
</script>
@endsection