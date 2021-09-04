@extends('layout')
@php
    $var = "Class"
@endphp

@section('title')
    {{$var}} | Admin
@endsection 

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
<body class="sb-nav-fixed">
   
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/teachers/dashboard">Admin | {{$var}}</a>
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
                    <li><a class="dropdown-item" href="/teachers/logout">Logout</a></li>
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
                        <a class="nav-link" href="/teachers/dashboard">
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

                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h2><span class="fw-1">Hello!</span> <strong style="text-transform: uppercase">{{session('teacher')['name']}}</strong></h2>
                        </div>
                        <div class="col-md-6 ">
                            <form action="punchout/" id="punchout" method="POST">
                            @csrf
                            <input type="hidden" name="t_id" value="{{session('teacher')['id']}}" id="t_id" >
                            @if (session('teacher')['punchout'] == 0)
                            
                                <button type="submit" class="btn btn-outline-primary rounded float-end" id="teacher_punchout"   >Punch out</button>
                            @else
                                <button class="btn btn-outline-primary rounded float-end" disabled>  Punch out</button>
                            
                            @endif
                            </form>

                            <form action="punchin/" id="punchin" method="POST">
                                @csrf
                                <input type="hidden" name="t_id" value="{{session('teacher')['id']}}" id="t_id" >
                                @if (session('teacher')['punchin'] == 0)
                                
                                    <button type="submit" class="btn btn-outline-primary rounded float-end mx-3 mr-sm-0" id="teacher_punchin"   >Punch in </button>
                                    @else
                                    <button type="submit" class="btn btn-outline-primary rounded float-end mx-3 mr-sm-0"   disabled > Punch in </button>
                                    
                                @endif
                            </form>
                        </div>
                    </div>
                
                    <hr>
                </div>
                
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <h1 class="mt-4">{{$var}} : <strong>{{$course->name}}</strong></h1>
                        </div>
                        <div class="col-md-4 float-end">
                            <button class="btn btn-outline-primary mt-4 float-end"  data-bs-toggle="modal" data-bs-target="#ActiveModal"> + create new post</button>
                        </div>
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

        {{-- toaster start here --}}
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 110">
            <div id="Toastpunchin" class="toast bg-success hide" role="alert" aria-live="assertive" data-autohide="true" data-bs-animation="true" aria-atomic="true">
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
        {{-- toaster start here --}}
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 110">
            <div id="Toastpunchout" class="toast bg-success hide" role="alert" aria-live="assertive" data-autohide="true" data-bs-animation="true" aria-atomic="true">
              <div class="toast-header bg-outline-success">
                <strong class="me-auto">Successfully Punched out...</strong>
                <small>Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body bg-white">
                <strong style="text-transform: uppercase">{{session("teacher")['name']}}</strong> has been punched out...
              </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
         var punchinel = document.getElementById('Toastpunchin');
        var punchin = bootstrap.Toast.getOrCreateInstance(punchinel) ;
        var punchoutel = document.getElementById('Toastpunchout');
        var punchout = bootstrap.Toast.getOrCreateInstance(punchoutel); 

        
        $("#punchin").submit(function (e) {
            e.preventDefault();
            var form = $('#punchin');
            var action = form.attr('action');
            var t_id = $("#t_id").val();
            var pathname = window.location.pathname; 
            
            $.ajax({
            type: "POST",
            url: pathname+"/"+action+t_id,
            data: form.serialize(), // serializes the form's elements.
            success:function(response){
                // window.swal("Success", response.msg, "success")
                // .then(function(value) {
                //             location.reload();
                //         });
                punchin.show()
                $("#teacher_punchin").attr("disabled","disabled");
             
            },
            error:function(requestObject){
            $("#form").modal('toggle');

                    window.swal("Oops!", requestObject.errorMsg, "error")
                    .then(function(value) {
                            location.reload();
                        });
                    
                    
                        

            }
            });
        });
        $("#punchout").submit(function (e) {
            e.preventDefault();
            var form = $('#punchout');
            var action = form.attr('action');
            var t_id = $("#t_id").val();
            var pathname = window.location.pathname; 

            $.ajax({
            type: "POST",
            url: pathname+"/"+action+t_id,
            data: form.serialize(), // serializes the form's elements.
            success:function(response){
                // window.swal("Success", response.msg, "success")
                // .then(function(value) {
                //             location.reload();
                //         });
                punchout.show()
                $("#teacher_punchout").attr("disabled","disabled");
             
            },
            error:function(requestObject){
            $("#form").modal('toggle');

                    window.swal("Oops!", requestObject.errorMsg, "error")
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