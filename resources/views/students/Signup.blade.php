@extends('layout')

@section('title')
    Sign up | Students
@endsection

@section('content')
<x-navbar/>
<div class="registration-form mt-5">
    <form action="signup" method="POST" >
        @csrf
        <h1 class="text-center mb-4">Signup for students</h1>
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
        @php
          $items = DB::select('SELECT * from modules 
          where parent= 0');
          foreach ($items as $key ) {
            
            echo '<option value="'.$key->id.'">'.$key->name.'</option>';               
          }
        @endphp

        
        {{-- <option value="1">English Language</option>
        <option value="2">Tuition</option>
        <option value="3">Computer Courses</option>
        <option value="4">IELTS</option>
        <option value="5">Business</option> --}}
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

    var somedata = "";


    // console.log(data)
    var web = window.location.origin;
    // console.log(web)
  fetch(web+"/students/getSubCourses/"+data)
  .then((response) => {
    return  response.json();
  }).then((myJson) => {
    somedata = myJson
    var optionsDAta ="";
    somedata.forEach(element => {
        optionsDAta+=`<option value="${element.id}">${element.name}</option>`;
      });
    // console.log(optionsDAta)
    options = `<div class="form-group">
        <select class="form-select item " aria-label="Default select example" id="module" name="sub_interest" required>
      <option value='' selected>Select course</option>
        ${optionsDAta}
      </select>
  </div>`;
      
      // console.log(options) ;
      switch (data) {
      case '1':
        document.getElementById('ele').innerHTML = options;
        
        break;
        case '2':
        document.getElementById('ele').innerHTML = options;
        break;
        case '3':
          document.getElementById('ele').innerHTML = options;
        
        break;
        case '4':
          document.getElementById('ele').innerHTML = "";
        
        break;
        case '5':
          document.getElementById('ele').innerHTML = "";
        
        break;
      default:
        break;
    }

  });
  //   l = [ `<div class="form-group">
  //       <select class="form-select item " aria-label="Default select example" id="module" name="sub_interest" required>
  //     <option value='' selected>Select Module</option>
  //     <option value="7">Beginner</option>
  //     <option value="8">Module - 1</option>
  //     <option value="9">Module - 2</option>
  //     <option value="10">Module - 3</option>
  //     <option value="11">Special Advance</option>
  //     <option value="12">Conversation</option>
  //   </select>
  // </div>`,
  // `<div class="form-group ">
  
  //   <select class="form-select item " aria-label="Default select example" id="tuition" name="sub_interest" required>
  //     <option value='' selected>Select tuition</option>
  //     <option value="13">6th</option>
  //     <option value="14">7th</option>
  //     <option value="15">8th</option>
  //     <option value="16">9th</option>
  //     <option value="17">Matric</option>
  //     <option value="18">1st year</option>
  //     <option value="19">2nd year</option>
  //   </select>
  // </div>`,
  // `<div class="form-group ">
  
  //   <select class="form-select item " aria-label="Default select example" id="Computer" name="sub_interest" required>
  //     <option value='' selected>Select Computer Course</option>
  //     <option value="20">Programming</option>
  //     <option value="21">Graphics</option>
  //     <option value="22">Video Editing</option>
  //     <option value="23">MS Office</option>
  //   </select>
  // </div>`];
  //   switch (data) {
  //     case '1':
  //       document.getElementById('ele').innerHTML = l[0];
        
  //       break;
  //       case '2':
  //       document.getElementById('ele').innerHTML = l[1];
  //       break;
  //       case '3':
  //         document.getElementById('ele').innerHTML = l[2];
        
  //       break;
  //       case '4':
  //         document.getElementById('ele').innerHTML = "";
        
  //       break;
  //       case '5':
  //         document.getElementById('ele').innerHTML = "";
        
  //       break;
  //     default:
  //       break;
  //   }
  }
</script>
@endsection