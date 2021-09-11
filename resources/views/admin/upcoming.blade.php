@extends('layout')
@php
    $var = "Upcoming T."
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
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="mt-4">{{$var}}</h1>

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-dark float-end mt-4" data-bs-toggle="modal" data-bs-target="#Message">+ Add upcoming teacher</button>

                        </div>
                    </div>
  
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            {{$var}}
                        </div>
                        <div class="card-body">
                            <table id="upcoming" class="cell-border compact stripe hover" >
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Starting Time</th>
                                        <th>Ending Time</th>
                                        <th>Contact no</th>
                                        {{-- <th>Edit</th> --}}
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $item)
                                <tr>
                                <td>{{$item['id']}}</td>
                                <td>{{$item['name']}}</td>
                                <td>{{date('h:i',strtotime($item['s_timing']))}}</td>
                                <td>{{date('h:i',strtotime($item['e_timing']))}}</td>
                                <td>{{$item['contact']}}</td>
                                
                                {{-- <td><a href="edit/{{$item['s_id']}}" class="btn btn-outline-warning">Edit</a></td> --}}
                                <td>
                                    
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button 
                                        data-id="{{$item['id']}}"  
                                        data-name="{{$item['name']}}"  
                                        data-s_time="{{$item['s_timing']}}"  
                                        data-e_time="{{$item['e_timing']}}"  
                                        data-contact="{{$item['contact']}}"  
                                     
                                        class="btn btn-outline-warning edit_btn">Edit</button>
                                        
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
                        <div class="text-muted">Copyright &copy; {{ $siteTitle }} 2021</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
        

        {{-- add modal --}}
        <div class="modal fade" id="Message" tabindex="-1" aria-labelledby="MessageLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="MessageLabel">Create new post</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
        <div class="modal-body">
                <form  id="Add_teacher" method="POST" >
                    @csrf
                <div class="row mb-md-4">
                    <div class="form-group col-md-12  mb-3 mb-md-0">
                        <label for="name">Name</label>
                        <input type="text" class="form-control item" id="c_name" name="name" placeholder="Username" required>
                    </div>
                </div>
        
          
                <div class="row my-md-4">
                    <div class="form-group col-md-6  mb-3 mb-md-0">
        
                        <label for="s_time">Start Timing</label>
                        <input type="time" class="form-control item" id="c_s_time" placeholder="starting time" name="s_time" required>
                    </div>
                    <div class="form-group col-md-6  mb-3 mb-md-0" >
                        <label for="e_time">Ending Timing</label>
                        <input type="time" class="form-control item" id="c_e_time" name="e_time" placeholder="ending time" required>
                    </div>
                </div>
               
         
                <div class="row mb-md-4">
                    <div class="form-group col-md-12  mb-3 mb-md-0">
                        <label for="contact">Contact </label>
                        <input type="number" class="form-control item" id="c_contact" name="contact" placeholder="contact no" required>
                    </div>
                </div>
                
            
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="sub">Add</button>
                </div>
            </form>
        
              </div>
            </div>
          </div>
        </div>
        
       <!-- edit Modal -->
<div class="modal fade" id="form_modal" tabindex="-1" aria-labelledby="form_modalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="form_modalLabel">Edit upcoming teacher</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  id="Edit_teacher" method="POST" >
                        @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row mb-md-4">
                        <div class="form-group col-md-12  mb-3 mb-md-0">
                            <label for="name">Name</label>
                            <input type="text" class="form-control item" id="name" name="name" placeholder="Username" required>
                        </div>
                    </div>

            
                    <div class="row my-md-4">
                        <div class="form-group col-md-6  mb-3 mb-md-0">

                            <label for="s_time">Start Timing</label>
                            <input type="time" class="form-control item" id="s_time" placeholder="starting time" name="s_time" required>
                        </div>
                        <div class="form-group col-md-6  mb-3 mb-md-0" >
                            <label for="e_time">Ending Timing</label>
                            <input type="time" class="form-control item" id="e_time" name="e_time" placeholder="ending time" required>
                        </div>
                    </div>
           
     
                    <div class="row mb-md-4">
                        <div class="form-group col-md-12  mb-3 mb-md-0">
                            <label for="contact">Contact </label>
                            <input type="number" class="form-control item" id="contact" name="contact" placeholder="contact no" required>
                        </div>
                    </div>
                    
        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="subedit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
       <!-- edit Modal -->
{{-- <div class="modal fade" id="create_form_modal" tabindex="-1" aria-labelledby="create_form_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="create_form_modalLabel">Add upcoming teacher</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form  id="Add_teacher" method="POST" >
                @csrf
            <div class="row mb-md-4">
                <div class="form-group col-md-12  mb-3 mb-md-0">
                    <label for="name">Name</label>
                    <input type="text" class="form-control item" id="name" name="name" placeholder="Username" required>
                </div>
            </div>

      
            <div class="row my-md-4">
                <div class="form-group col-md-6  mb-3 mb-md-0">

                    <label for="s_time">Start Timing</label>
                    <input type="time" class="form-control item" id="s_time" placeholder="starting time" name="s_time" required>
                </div>
                <div class="form-group col-md-6  mb-3 mb-md-0" >
                    <label for="e_time">Ending Timing</label>
                    <input type="time" class="form-control item" id="e_time" name="e_time" placeholder="ending time" required>
                </div>
            </div>
           
     
            <div class="row mb-md-4">
                <div class="form-group col-md-12  mb-3 mb-md-0">
                    <label for="contact">Contact </label>
                    <input type="text" class="form-control item" id="contact" name="contact" placeholder="contact no" required>
                </div>
            </div>
            
        
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div> --}}


  
        <script>
    
          
$('.edit_btn').click(function(e) {
        e.preventDefault();
        
        var id = $(this).data('id');
        var name = $(this).data('name');
        var s_time = $(this).data('s_time');
        var e_time = $(this).data('e_time');
        var contact  = $(this).data('contact');

        // sending values to modal
        $('#id').val(id);
        $("#name").val(name);
        $("#s_time").val(s_time);
        $("#e_time").val(e_time);
        $("#contact").val(contact);
        
        $("#form_modal").modal('toggle');
        
    

    });



    $('#Edit_teacher').submit(function(e){
    
    $("#subedit").attr("disabled","disabled");
    e.preventDefault();

        form = $("#Edit_teacher");
        $.ajax({
            type : 'POST',
            url  : '/admin/upcoming',
            data : form.serialize(),
            success:function(response){
                window.swal("Success", response.msg, "success")
                            .then(function(value) {
                               location.reload();
                            });
            },
            error:function(requestObject){
                   $("#form_modal").modal('toggle');
    
                         window.swal("Oops!",  requestObject.responseJSON.errorMsg.errorInfo[2], "error");
                            
                    // location.reload();
                                        setTimeout(() => {
                    location.reload();
                      },2000);
  
                }
        });
        
    });
    $('#Add_teacher').submit(function(e){
    
        $("#sub").attr("disabled","disabled");
    e.preventDefault();

        form = $("#Add_teacher");
        
        $.ajax({
            type : 'POST',
            url  : '/admin/upcomingcreate',
            data : form.serialize(),
            success:function(response){
                window.swal("Success", response.msg, "success")
                            .then(function(value) {
                               location.reload();
                            });
            },
            error:function(requestObject){
                   $("#form_modal").modal('toggle');
    
                         window.swal("Oops!",  requestObject.responseJSON.errorMsg.errorInfo[2], "error");
                            
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