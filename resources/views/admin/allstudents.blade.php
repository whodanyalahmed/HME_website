@extends('layout')
@php
    $var = "All Students"
@endphp

@section('title')
    {{$var}} | Admin
@endsection 

@section('content')
<body class="sb-nav-fixed">
    <x-dash-side-nav data="{{$var}}"/>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">{{$var}}</h1>
                    {{-- <div  my-4>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Primary Card</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Warning Card</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Success Card</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Danger Card</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
  
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            {{$var}}
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="cell-border compact stripe hover" >
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Coaching Id</th>
                                        <th>Email</th>
                                        <th>Active</th>
                                        <th>Joined Date</th>
                                        <th>fee status</th>
                                        <th>Qualification</th>
                                        <th>Onsite</th>
                                        <th>Interested in</th>
                                        {{-- <th>Edit</th> --}}
                                        <th>Edit/Disable/Acitve</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $item)
                                <tr>
                                <td>{{$item['s_id']}}</td>
                                <td>{{$item['s_name']}}</td>
                                <td>{{$item['s_co_id']}}</td>
                                <td>{{$item['s_email']}}</td>
                                <td>{{($item['s_status']) ? "yes" : "no"}}</td>
                                <td>{{$item['s_joined_date']}}</td>
                                @php
                                $d = $item['fee_status'];
                                $s = ($d == 0) ? "not paid" : (($d == 1)  ? "paid" : "pending");
                                @endphp
                                <td>{{$s}}
                                </td>
                                <td>{{$item['q_name']}}</td>
                                <td>{{($item['onsite']) ? "yes" : "no"}}</td>
                                <td>{{$item['i_name']}}</td>
                                {{-- <td><a href="edit/{{$item['s_id']}}" class="btn btn-outline-warning">Edit</a></td> --}}
                                <td>
                                    
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button 
                                        data-id="{{$item['s_id']}}"  
                                        data-name="{{$item['s_name']}}"  
                                        data-co="{{$item['s_co_id']}}"  
                                        data-email="{{$item['s_email']}}"  
                                        data-password="{{$item['s_password']}}"  
                                        data-contactno="{{$item['s_contactno']}}"  
                                        data-joined_date="{{$item['s_joined_date']}}"  
                                        data-fee_status="{{$item['fee_status']}}"  
                                        data-interest="{{$item['interest']}}"  
                                        data-Qualification_id="{{$item['Qualification_id']}}"  
                                        data-is_new_admission="{{$item['is_new_admission']}}"  
                                        data-onsite="{{$item['onsite']}}"  
                                        data-sub_interest_id="{{$item['sub_interest_id']}}" 
                                        class="btn btn-outline-warning edit_btn">Edit</button>
                                        <a href="delete/{{$item['s_id']}}" name="action"  onclick="update(this,{{$item['s_id']}})" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-danger">Disable</a>
                                        <a href="active/{{$item['s_id']}}" name="action" onclick="update(this,{{$item['s_id']}})" data-bs-toggle="modal" data-bs-target="#ActiveModal" class="btn btn-outline-success">Active</a>
                                        
                                      </div>
                                </td>
                                
                            </tr>
                                
                                @endforeach
                                 
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Area Chart Example
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Bar Chart Example
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; HME 2021</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Disable</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you really wanna disable?
                </div>
                <div class="modal-footer">
                <form action="" method="post" name="form" id="Disform">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-primary">Disable</button>
                </form>
                </div>
            </div>
            </div>
        </div>
         <!-- Modal -->
         <div class="modal fade" id="ActiveModal" tabindex="-1" aria-labelledby="ActiveModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="ActiveModalLabel">Conirm Active</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you really wanna Active?
                </div>
                <div class="modal-footer">
                <form action="" method="post" name="form" id="Actform">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Active</button>
                </form>
                </div>
            </div>
            </div>
        </div>


        {{-- Edit modal --}}
        
       <!-- edit Modal -->
<div class="modal fade" id="form_modal" tabindex="-1" aria-labelledby="form_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="form_modalLabel">Edit Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form  id="Edit_student" method="POST" >
                @csrf
            <input type="hidden" name="id" id="s_id">
            <div class="row mb-md-4">
                <div class="form-group col-md-6  mb-3 mb-md-0">
                    <label for="name">Name</label>
                    <input type="text" class="form-control item" id="username" name="name" placeholder="Username" required>
                </div>
                <div class="form-group col-md-6  mb-3 mb-md-0">
                    <label for="password">Password</label>
                    <input type="password" class="form-control item" id="password" name="password" placeholder="Password" required>
                </div>
            </div>

            <div class="row my-md-4">
                <div class="form-group col-md-6  mb-3 mb-md-0">
                    <label for="co_id">Coaching Id</label>
                    <input type="text" class="form-control item" id="co_id" name="co_id" placeholder="co_id" required>
                </div>
                <div class="form-group col-md-6  mb-3 mb-md-0">
                    <label for="fee_status">Fee Status</label>
                    <select class="form-select item" aria-label="Default select example" id="fee_status"  name="fee_status" required>
                        <option value='' selected>Fee status</option>
                        <option value="0">Not paid</option>
                        <option value="3">Pending</option>
                        <option value="1">Paid</option>
                    </select>
                </div>
            </div>
            <div class="row my-md-4">
                <div class="form-group col-md-6  mb-3 mb-md-0">

                    <label for="email">Email</label>
                    <input type="email" class="form-control item" id="email" placeholder="Email" name="email" required>
                </div>
                <div class="form-group col-md-6  mb-3 mb-md-0" >
                    <label for="phone-number">Whatsapp</label>
                    <input type="text" class="form-control item" id="phone-number" name="number" placeholder="Whatsapp Number" required>
                </div>
            </div>
            <div class="row my-md-4">
                <div class="form-group col-md-6  mb-3 mb-md-0">
                    <label for="field">Interested</label>
                <select class="form-select item " onchange="SelectField()" id="field" aria-label="Default select example" name="interest" required>
                    <option value='' selected>Interested in</option>
                    <option value="1">English Language</option>
                    <option value="2">Tuition</option>
                    <option value="3">Computer Courses</option>
                    <option value="4">IELTS</option>
                    <option value="5">Business</option>
                </select>
                </div>
                <div id="ele" class="col-md-6  mb-3 mb-md-0"></div>
                </div>
            <div class="row my-md-4">
                <div class="form-group col-md-12  mb-3 mb-md-0">
                    <label for="Qualification">Qualification</label>
                    <select class="form-select item" aria-label="Default select example" id="Qualification"  name="Qualification" required>
                        <option value='' selected>Qualification from</option>
                        <option value="1">Sindh Board</option>
                        <option value="2">Aga khan board</option>
                        <option value="3">'O' Levels</option>
                    </select>
                </div>
            </div>
     
            
            
            <label for="onsite">Classes</label>
            <div class="row my-3 px-5">
                    <div class="form-check col-md-6 mb-3 mb-md-0">
                        <input class="form-check-input" type="radio" name="onsite" value="0" id="online"  >
                        <label class="form-check-label" for="online">
                        Online
                        </label>
                    </div>
                    <div class="form-check col-md-6  mb-3 mb-md-0">
                        <input class="form-check-input" type="radio" name="onsite" value="1" id="onsite" >
                        <label class="form-check-label" for="onsite">
                        Onsite
                        </label>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
        <script>
    function SelectField() {
        var data = document.getElementById('field').value
        console.log(data)
        l = [ `<div class="form-group">
            <label for="subinterest">Module</label>
            <select class="form-select item " aria-label="Default select example" id="subinterest" name="sub_interest" required>
        <option value='' selected>Select Module</option>
        <option value="7">Beginner</option>
        <option value="8">Module - 1</option>
        <option value="9">Module - 2</option>
        <option value="10">Module - 3</option>
        <option value="11">Special Advance</option>
        <option value="12">Conversation</option>
        </select>
    </div>`,
        `<div class="form-group ">
            <label for="subinterest">Class</label>
    
        <select class="form-select item " aria-label="Default select example" id="subinterest" name="sub_interest" required>
        <option value='' selected>Select tuition</option>
        <option value="13">6th</option>
        <option value="14">7th</option>
        <option value="15">8th</option>
        <option value="16">9th</option>
        <option value="17">Matric</option>
        <option value="18">1st year</option>
        <option value="19">2nd year</option>
        </select>
    </div>`,
    `<div class="form-group ">
        <label for="subinterest">Course</label>
    
        <select class="form-select item " aria-label="Default select example" id="subinterest" name="sub_interest" required>
        <option value='' selected>Select Computer Course</option>
        <option value="20">Programming</option>
        <option value="21">Graphics</option>
        <option value="22">Video Editing</option>
        <option value="23">MS Office</option>
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
            case '4':
            document.getElementById('ele').innerHTML = "";
            
            break;
            case '5':
            document.getElementById('ele').innerHTML = "";
            
            break;
        default:
            break;
        }
    }
            function update(ele,p) {
                action = $(ele).select();
                href = action.attr('href');
                
                // console.log(href);
                var forms = document.getElementsByName('form')
                forms.forEach(element => {
                    element.setAttribute('action','student/'+href);
                });

                var names = document.getElementsByName('id');
                names.forEach(ele => {
                    ele.setAttribute('value',p);
                });
            }
            // $("#delete").click(function(){
            // $('#form').attr('action');
            // $.ajax({url: "demo_test.txt", success: function(result){
            //     if(result.success == true){ // if true (1)
            //         setTimeout(function(){// wait for 5 secs(2)
            //             location.reload(); // then reload the page.(3)
            //         }, 5000); 
            // }});
            // });


            $("#Actform").submit(function(e) {


                e.preventDefault();
             // avoid to execute the actual submit of the form.

            var form = $('#Actform');
            var url = form.attr('action');
            console.log(url)

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success:function(response){
                    window.swal("Success", response.msg, "success")
                            .then(function(value) {
                                location.reload();
                            });
            },
            error:function(requestObject, error, errorThrown){
                   $("#form").modal('toggle');
    
                   window.swal("Oops!", requestObject.responseJSON.errorMsg, "error")
                         .then(function(value) {
                                location.reload();
                            });
                         
  
                }
                });
                return false;

});
            $("#Disform").submit(function(e) {

                e.preventDefault();
                // return false;
             // avoid to execute the actual submit of the form.

            var form = $('#Disform');
            var url = form.attr('action');
            console.log(url)

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success:function(response){
                    window.swal("Success", response.msg, "success")
                    .then(function(value) {
                                location.reload();
                            });
            },
            error:function(requestObject, error, errorThrown){
                   $("#form").modal('toggle');
    
                         window.swal("Oops!", requestObject.responseJSON.errorMsg, "error")
                         .then(function(value) {
                                location.reload();
                            });
                         
                         
                            
  
                }
                });

                return false;
});



$('.edit_btn').click(function(e) {
        e.preventDefault();
        
        var id = $(this).data('id');
        var name = $(this).data('name');
        var co_id = $(this).data('co');
        var email = $(this).data('email');
        var password = $(this).data('password');
        var contact_no  = $(this).data('contactno');
        var joined_date = $(this).data('joined_date');
        var fee_status = $(this).data('fee_status');
        var interest = $(this).data('interest');
        var Qualification_id = $(this).data('qualification_id');
        var is_new_admission = $(this).data('is_new_admission');
        var onsite = $(this).data('onsite');
        var sub_interest_id = $(this).data('sub_interest_id');

        // sending values to modal
        $('#s_id').val(id);
        $("#username").val(name);
        $("#password").val(password);
        $("#co_id").val(co_id);
        $("#email").val(email);
        $("#phone-number").val(contact_no);
        $("#field").val(interest).change();
        $("#Qualification").val(Qualification_id).change();
        $("#fee_status").val(fee_status).change();
        $("#subinterest").val(sub_interest_id).change();
        if(onsite == '0'){
            $('#online').attr("checked", "checked");
        }
        else{
            $('#onsite').attr("checked", "checked");

        }
        $("#form_modal").modal('toggle');
        
    

    });


    $('#Edit_student').submit(function(e){
    
    e.preventDefault();
    // var id_up =     $("#Charset_id").val();
    // var no_accounta = $("#account_no_ed").val();
    // var no_namea    = $("#account_name_ed").val();
    // var detailsa    = $("#account_detail_ed").val();
    // var closinga    = $("#closing_account_ed").val();
    // var parenta      = $("#parent_ed").val();
    var id = $('#s_id').val();
    var name = $("#username").val();
    var password =$("#password").val();
    var co_id =$("#co_id").val();
    var email = $("#email").val();
    var phone = $("#phone-number").val();
    var interest =$("#field").val();
    var fee_status =$("#fee_status").val();
    var onsite = $('input[name="onsite"]:checked').val();
    var _token = $('input[name="_token"]').val();
    var qualification = $("#Qualification").val();
    var sub_interest = $("#subinterest").val();

        $.ajax({
            type : 'POST',
            url  : 'student/update/',
            data : {
                id:id,
                name:name,
                email:email,
                password:password,
                co_id:co_id,
                phone:phone,
                interest:interest,
                fee_status:fee_status,
                qualification:qualification,
                sub_interest:sub_interest,
                onsite:onsite,
                _token:_token
            },
            success:function(response){
                window.swal("Success", response.msg, "success")
                            .then(function(value) {
                               location.reload();
                            });
            },
            error:function(requestObject){
                   $("#form_modal").modal('toggle');
    
                         window.swal("Oops!", requestObject.errorMsg, "error");
                            
                    // location.reload();
                                        setTimeout(() => {
                    location.reload();
                      },2000);
  
                }
        });
        
    });
       </script>
         
    <script src="/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="/assets/demo/chart-area-demo.js"></script>
    <script src="/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="/js/datatables-simple-demo.js"></script>
{{-- <div class="container">
        
<h1>Hello! {{session('admin')}} </h1>
    <ul>
    @foreach ($data as $item)
        <li>{{$item->s_id}} - {{$item->s_name}}</li>
    @endforeach
    </ul>
</div> --}}
@endsection