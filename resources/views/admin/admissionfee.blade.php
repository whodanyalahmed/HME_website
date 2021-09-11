@extends('layout')
@php
    $var = "Admission Fees"
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
                            <table id="admissionfeetab" class="cell-border compact stripe hover" >
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>fee</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $item)
                                <tr>
                                <td>{{$item['id']}}</td>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['fee']}}</td>
                                {{-- <td><a href="edit/{{$item['s_id']}}" class="btn btn-outline-warning">Edit</a></td> --}}
                                <td>
                                    
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button 
                                        data-id="{{$item['id']}}"  
                                        data-name="{{$item['name']}}"  
                                        data-fee="{{$item['fee']}}"  
                                     
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
        

        {{-- Edit modal --}}
        
       <!-- edit Modal -->
<div class="modal fade" id="form_modal" tabindex="-1" aria-labelledby="form_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="form_modalLabel">Edit Admission Fee Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form  id="admissionfee" method="POST" >
                @csrf
            <input type="hidden" name="id" id="id">
            <div class="row mb-md-4">
                <div class="form-group col-md-12  mb-3 mb-md-0">
                    <label for="name">Name</label>
                    <input type="text" class="form-control item" id="name" name="name" placeholder="Username" required disabled>
                </div>
            </div>

      
     
           
     
            <div class="row mb-md-4">
                <div class="form-group col-md-12  mb-3 mb-md-0">
                    <label for="fee">Fees </label>
                    <input type="text" class="form-control item" id="fee" name="fee" placeholder="fee" required>
                </div>
            </div>
            
        
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="admsubmit"class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
        <script>
    
          
$('.edit_btn').click(function(e) {
        e.preventDefault();
        
        var id = $(this).data('id');
        var name = $(this).data('name');
        var fee  = $(this).data('fee');

        // sending values to modal
        $('#id').val(id);
        $("#name").val(name);
        $("#fee").val(fee);
        
        $("#form_modal").modal('toggle');
        
    

    });


    $('#admissionfee').submit(function(e){
    
    e.preventDefault();

        form = $("#admissionfee");
        $("#admsubmit").attr("disabled","disabled");

        $.ajax({
            type : 'POST',
            url  : '/admin/admissionfee',
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