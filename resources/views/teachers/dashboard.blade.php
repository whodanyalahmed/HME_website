@extends('layout')
@php
    $var = "Dashboard"
@endphp

@section('title')
    {{$var}} | Admin
@endsection 

@section('content')
<body class="sb-nav-fixed">
   
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="">Admin | {{$var}}</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="hidden" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                {{-- <button class="btn btn-primary" id="btnNavbarSearch" type="hidden"> --}}
                    {{-- <i class="fas fa-search"></i> --}}
                {{-- </button> --}}
            </div>
        </form>
       
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="far fa-user"></i></div>
                            Students
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="students">All Students</a>
                                <a class="nav-link" href="studentsfee">Students Fee Details</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="#">Login</a>
                                        <a class="nav-link" href="#">Register</a>
                                        <a class="nav-link" href="#">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="#">401 Page</a>
                                        <a class="nav-link" href="#">404 Page</a>
                                        <a class="nav-link" href="#">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                        {{session('teacher')['name']}}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="mt-4">{{$var}}</h1>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4 float-end">
                            <button class="btn btn-outline-success mt-4 float-end"  data-bs-toggle="modal" data-bs-target="#ActiveModal"> + create new class</button>
                        </div>
                    </div>
                </div>
                <div class="container">

                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h2><span class="fw-1">Hello!</span> <strong style="text-transform: uppercase">{{session('teacher')['name']}}</strong></h2>
                        </div>
                        <div class="col-md-6 ">
                            <button class="btn btn-outline-warning float-end">Punch out</button>
                            <form action="/teachers/punchin/" id="punchin" method="POST">
                                @csrf
                                <input type="hidden" name="t_id" value="{{session('teacher')['id']}}" id="t_id" >
                                
                                <button type="submit" class="btn btn-outline-warning float-end mx-3 mr-sm-0" id="teacher_punchin"   >Punch in </button>
                            </form>
                        </div>
                    </div>
                    <h4 class="my-3">Classes</h4>
                    <div class="row">
                        @foreach ($courses as $course)
                            
                        <div class="col-md-6">
                            <div class="card border-dark mb-4" >
                                <input type="hidden" name="course_id" value="{{$course->c_id}}">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-3">

                                            Course id: <strong>{{$course->c_id}}</strong> 
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-3 float-end text-right">
                                            <button class="btn btn-outline-danger float-end" onclick="update(this)" data-id="{{$course->c_id}}"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>  
                                <div class="card-body">
                                  <h5 class="card-title"><a href="#" class="text-dark">{{$course->course}}</a></h5>
                                  <p class="card-text">This is the class of <strong>{{$course->module}}</strong></p>
                                </div>
                                <div class="card-footer bg-transparent border-dark">No. of students: <strong>{{$course->noofstudents}}</strong></div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                    
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; {{ $siteTitle }} 2021</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

             <!-- Modal -->
             <div class="modal fade" id="ActiveModal" tabindex="-1" aria-labelledby="ActiveModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="ActiveModalLabel">Create new class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                    <form action="class/create" method="post" name="form" id="CreateClass">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-select item rounded" aria-label="Default select example" name="module" id="module" required>
                                        <option value='' selected>Select Class</option>
                                        <option value="7">Beginner</option>
                                        <option value="8">Module - 1</option>
                                        <option value="9">Module - 2</option>
                                        <option value="10">Module - 3</option>
                                        <option value="11">Special Advance</option>
                                        <option value="12">Conversation</option>
                                        <option value="13">6th</option>
                                        <option value="14">7th</option>
                                        <option value="15">8th</option>
                                        <option value="16">9th</option>
                                        <option value="17">Matric</option>
                                        <option value="18">1st year</option>
                                        <option value="19">2nd year</option>
                                        <option value="20">Programming</option>
                                        <option value="21">Graphics</option>
                                        <option value="22">Video Editing</option>
                                        <option value="23">MS Office</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label for="name">Class Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label for="students"><strong>Select Students</strong></label>
                                    <table  id="students" class="table table-responsive table-striped table-hover compact">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Id </th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $items = DB::select('select s_id,s_name from students');
                                            @endphp

                                            @foreach ($items  as $item)
                                                
                                                <tr >

                                                    <td><input class="form-check-input" type="checkbox" name="students[]" id="student{{$item->s_id}}" value="{{$item->s_id}}" ></td>
                                                    {{-- <label for="student{{$item->s_id}}" class="form-check-label"> --}}
                                                        
                                                        <td ><label for="student{{$item->s_id}}" >{{$item->s_id}}</label></td>
                                                        <td> <label for="student{{$item->s_id}}" >{{$item->s_name}}</label></td>
                                                    {{-- </label> --}}
                                                
                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        @csrf
                        <input type="hidden" name="t_id" value="{{session('teacher')['id']}}">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="CreateClass(this)">Create</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>
             <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you really wanna delete?
                </div>
                <div class="modal-footer">
                <form action="class/delete" method="post" name="form" id="Delete">
                    @csrf
                    <input type="hidden" name="id" value="" id="delete">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-danger">Delete</button>
                </form>
                </div>
            </div>
            </div>
        </div>

        {{-- toaster start here --}}
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 110">
            <div id="liveToast" class="toast bg-success hide" role="alert" aria-live="assertive" data-autohide="true" data-bs-animation="true" aria-atomic="true">
              <div class="toast-header bg-outline-success">
                <strong class="me-auto">Successfully Punched in...</strong>
                <small>Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body bg-white">
                <strong style="text-transform: uppercase">{{session("teacher")['name']}}</strong> has been punched in...
              </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script> 
   


        function update(params) {
            var id = $(params).data("id");
            $("#delete").val(id);
            $('#exampleModal').modal('toggle');
        }
        $("#Delete").submit(function(e) {

            e.preventDefault();
            // return false;
            // avoid to execute the actual submit of the form.

            var form = $('#Delete');
            var url = form.attr('action');


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


        function CreateClass(params) {
            
            var students = $.map($('input[name="students[]"]:checked'), function(c){return c.value; });
            console.log(students);

            
        $("#CreateClass").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $('#CreateClass');
        var url = form.attr('action');
    
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
            
        });
        }
        var myToastEl = document.getElementById('liveToast')
        var myToast = bootstrap.Toast.getOrCreateInstance(myToastEl) 
        $("#punchin").submit(function (e) {
            e.preventDefault();
            var form = $('#punchin');
            var action = form.attr('action');
            var t_id = $("#t_id").val();
 

            $.ajax({
            type: "POST",
            url: action+t_id,
            data: form.serialize(), // serializes the form's elements.
            success:function(response){
                // window.swal("Success", response.msg, "success")
                // .then(function(value) {
                //             location.reload();
                //         });
                myToast.show()

             
            },
            error:function(requestObject, error, errorThrown){
            $("#form").modal('toggle');

                    window.swal("Oops!", requestObject.responseJSON.errorMsg, "error")
                    .then(function(value) {
                            location.reload();
                        });
                    
                    
                        

            }
            });
        });
    </script>
    
    <script src="/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="/js/datatables-simple-demo.js"></script>
{{-- <div class="container">
        
<h1>Hello! {{session('admin')}} </h1>
    <ul>
    @foreach ($var as $item)
        <li>{{$item->s_id}} - {{$item->s_name}}</li>
    @endforeach
    </ul>
</div> --}}
@endsection