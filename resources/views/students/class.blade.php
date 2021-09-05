@extends('layout')
@php
    $var = "Class"
@endphp

@section('title')
    {{$var}} | Student
@endsection 

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
<body class="sb-nav-fixed">
   
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/students/dashboard">Student | {{$var}}</a>
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
                    <li><a class="dropdown-item" href="/students/logout">Logout</a></li>
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
                        <a class="nav-link" href="/students/dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="far fa-user"></i></div>
                            Classes
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">

                                <a class="nav-link" href="/students/dashboard"><i class="fas fa-list me-2"></i>All Classes</a>

                                @foreach ($courses as $cou)
                                
                                <a class="nav-link" href="/students/class/{{$cou->course_id}}"><i class="fas fa-arrow-right me-2"></i>{{$cou->name}}</a>

                                @endforeach
                            </nav>
                        </div>
                        {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a> --}}
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            {{-- <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
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
                            </nav> --}}
                        </div>
                        {{-- <div class="sb-sidenav-menu-heading">Addons</div> --}}
                        {{-- <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a> --}}
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                        {{session('user')['name']}}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>

                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h2><span class="fw-1">Hello!</span> <strong style="text-transform: uppercase">{{session('user')['name']}}</strong></h2>
                        </div>
                       
                    </div>
                
                    <hr>
                </div>
                
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <h1 class="mt-4">{{$var}} : <strong>{{$course->name}}</strong></h1>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            @foreach ($messages as $message)
                                
                                <div class="accordion-item">
                                <h2 class="accordion-header rounded" id="panelsStayOpen-{{$message->id}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#panelsStayOpen-collapseOne{{$message->id}}" >
                                        
                                            <div class="col-md-8">
                                                <span class="text-dark">Message Id: <strong class="me-3">{{$message->id}}</strong></span>{{$message->posted_at}}

                                            </div>
                                            
                                        
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne{{$message->id}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-{{$message->id}}">
                                    <div class="accordion-body rounded">
                                    This is the posted at <strong>{{$message->posted_at}}</strong><br>
                                    The message/url is: <strong>{{$message->message}}</strong> 
                                    </div>
                                </div>
                                </div>
                            @endforeach
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
                <strong style="text-transform: uppercase">{{session("user")['name']}}</strong> has been punched in...
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
                <strong style="text-transform: uppercase">{{session("user")['name']}}</strong> has been punched out...
              </div>
            </div>
        </div>
<!-- Modal -->
<div class="modal fade" id="Message" tabindex="-1" aria-labelledby="MessageLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="MessageLabel">Create new post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="messsage/" method="POST" id="messageform">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <input type="hidden" name="t_id" id="t_id" value="{{session('user')['id']}}" />
                    <label for="exampleFormControlTextarea1" class="form-label">Enter url/message: </label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="message"></textarea>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="postbtn">post</button>
            </div>
        </form>
      </div>
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
                    Do you really want to delete message with id <strong><span id="msgId"></span></strong>?
                </div>
                <div class="modal-footer">
                <form action="delete/message" method="post" name="form" id="DeleteMessage">
                    @csrf
                    <input type="hidden" name="m_id" value="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-danger">Delete</button>
                </form>
                </div>
            </div>
            </div>
        </div>
         <!-- Modal -->
         <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="EditModalLabel">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="edit/message" method="post" name="form" id="EditMessage">
                <div class="modal-body">
                    <textarea class="form-control" id="EditTextarea" rows="5" name="message" value=""></textarea>
                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="m_id" value="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-primary">update</button>
                </form>
                </div>
            </div>
            </div>
        </div>
  
          
    <script src="/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="/js/datatables-simple-demo.js"></script>
{{-- <div class="container">
        
<h1>Hello! {{session('Student')}} </h1>
    <ul>
    @foreach ($var as $item)
        <li>{{$item->s_id}} - {{$item->s_name}}</li>
    @endforeach
    </ul>
</div> --}}
@endsection