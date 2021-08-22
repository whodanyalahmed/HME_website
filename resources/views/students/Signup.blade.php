@extends('layout')

@section('title')
    Sign up | Students
@endsection

@section('content')

<div class="registration-form">
    <form action="signup" method="POST" >
        @csrf
        <h1 class="text-center mb-4">Sign-Up for students</h1>
        <div class="form-icon">
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
    <div class="form-group col-4">
    <select class="form-select item " onchange="SelectField()" id="field" aria-label="Default select example" name="interest" required>
        <option value='' selected>Interested in</option>
        <option value="1">English Language</option>
        <option value="2">Tuition</option>
        <option value="3">Computer Courses</option>
        <option value="4">IELTS</option>
        <option value="5">Business</option>
      </select>
    </div>
    <div id="ele" class="col-8"></div>
    </div>
      <select class="form-select item" aria-label="Default select example" name="Qualification" required>
        <option value='' selected>Qualification from</option>
        <option value="1">Sindh Board</option>
        <option value="2">Aga khan board</option>
        <option value="3">'O' Levels</option>
      </select>
      <h5>Classes</h5>
      <div class="row px-5">
      <div class="form-check col">
        <input class="form-check-input" type="radio" name="onsite" value="0" id="online" checked >
        <label class="form-check-label" for="online">
          Online
        </label>
      </div>
      <div class="form-check col">
        <input class="form-check-input" type="radio" name="onsite" value="1" id="onsite" >
        <label class="form-check-label" for="onsite">
          Onsite
        </label>
      </div>
    </div>
    <div class="row">
        <div class="col form-group">
            <button type="submit" class="btn btn-block create-account">Create Account</button>
        </div>
        <div class="col mt-4"><a href="login">Already have an account?</a></div>
    </div>
</form>

</div>
<script>
  function SelectField() {
    var data = document.getElementById('field').value
    console.log(data)
    l = [ `<div class="form-group">
        <select class="form-select item " aria-label="Default select example" id="module" name="module" required>
      <option value='' selected>Select Module</option>
      <option value="7">Beginner</option>
      <option value="8">Module - 1</option>
      <option value="3">Module - 2</option>
      <option value="3">Module - 3</option>
      <option value="3">Special Advance</option>
      <option value="3">Conversation</option>
    </select>
  </div>`,
  `<div class="form-group ">
  
    <select class="form-select item " aria-label="Default select example" id="tuition" name="tuition" required>
      <option value='' selected>Select tuition</option>
      <option value="7">6th</option>
      <option value="8">7th</option>
      <option value="3">8th</option>
      <option value="3">9th</option>
      <option value="3">Matric</option>
      <option value="3">1st year</option>
      <option value="3">2nd year</option>
    </select>
  </div>`,
  `<div class="form-group ">
  
    <select class="form-select item " aria-label="Default select example" id="Computer" name="Computer" required>
      <option value='' selected>Select Computer Course</option>
      <option value="7">Programming</option>
      <option value="8">Graphics</option>
      <option value="3">Video Editing</option>
      <option value="3">MS Office</option>
    </select>
  </div>`];
    switch (data) {
      case '1':
        document.getElementById('ele').innerHTML = l[0];
        
        break;
        case '2':
        document.getElementById('ele').innerHTML = l[1];
        break;
        case '3':
          document.getElementById('ele').innerHTML = l[2];
        
        break;
      default:
        break;
    }
  }
</script>
@endsection