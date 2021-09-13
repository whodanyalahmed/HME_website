@extends('layout')
@php
    $var = "Classes"
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
                            <table id="feedbacktab" class="cell-border stripe hover" >
                                <thead>
                                    <tr>
                                        <th>Course Id</th>
                                        <th>Name</th>
                                        <th>Teacher Id</th>
                                        <th>Teacher name</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $item)
                                <tr>
                                <td>{{$item['id']}}</td>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['t_id']}}</td>
                                <td>{{$item['t_name']}}</td>

                                <td><a href="classedit" data-c_id="{{$item['id']}}"  data-t_id="{{$item['t_id']}}" data-c_name="{{$item['name']}}"  class="btn btn-outline-warning edit">Edit</a></td>
                                {{-- <td>
                                    
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button 
                                        data-id="{{$item['id']}}"  
                                        data-name="{{$item['name']}}"  
                                        data-fee="{{$item['fee']}}"  
                                     
                                        class="btn btn-outline-warning edit_btn">Edit</button>
                                        
                                      </div>
                                </td> --}}
                                
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
        
  <!-- edit Modal -->
  <div class="modal fade" id="form_modal" tabindex="-1" aria-labelledby="form_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="form_modalLabel">Edit Class <span class="fw-bold" id="classname"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form  id="Edit_class" method="POST" >
            @csrf
            <input type="hidden" name="id" id="id">
     

            <div class="row mb-md-4">
                <div class="form-group col-md-12  me-5 mb-md-0">
                    <h5 class="display-5">Change Teacher</h5>
                    <label for="from_teacher">From teacher</label>
                    <select class="form-select item" aria-label="Default select example" id="from_teacher" onchange="checkTeacher()" name="from_teacher" required>
                        <option value='' selected>select teacher</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{$teacher['t_id']}}">{{$teacher['t_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12  mt-4 mb-md-0">
                    <label for="to_teacher">To teacher</label>
                    <select class="form-select item" aria-label="Default select example" id="to_teacher" onchange="checkTeacher()"  name="to_teacher" required>
                        <option value='' selected>select teacher</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{$teacher['t_id']}}">{{$teacher['t_name']}}</option>
                        @endforeach
                    </select>
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
       
         
    <script src="/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="/assets/demo/chart-area-demo.js"></script>
    <script src="/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="/js/datatables-simple-demo.js"></script>
    <script>
    back = "";
    $(".edit").on('click',function(e){

        e.preventDefault();    
        // console.log(e);
        id = $(this).data('t_id');
        c_id = $(this).data('c_id');
        $("#id").val(c_id);
        name= $(this).data('c_name');
        
        $('#from_teacher').val(id).change();
        
        back = $("#from_teacher").val();
            action = $(this).select();
            href = action.attr('href');
            
            console.log(href);
            var forms = document.getElementById('Edit_class').setAttribute('action',href);


            var names = document.getElementById('classname').innerText = name;
            $("#form_modal").modal("toggle");
            return false;
        
        });
    function checkTeacher(){
        to_id = $("#to_teacher").val();
        from_id = $("#from_teacher").val();

        if(to_id == from_id){
            window.swal("Oops!","Cant select same teacher", "error")
            .then(function() {
                        $("#to_teacher").val("").change();
                        if(to_id == "" && from_id == ""){
                            location.reload();
                        }
                            });
        }
        
    }

    $("#Edit_class").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $('#Edit_class');
            var url = form.attr('action');
            $("button[type=submit]").attr("disabled","disabled");
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

            window.swal("Oops!",  requestObject.responseJSON.errorMsg.errorInfo[2], "error")
                    .then(function(value) {
                            location.reload();
                        });
                    

            }
    });
    
});
    </script>
@endsection