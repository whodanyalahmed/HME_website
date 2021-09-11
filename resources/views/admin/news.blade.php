@extends('layout')
@php
    $var = "News"
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
                            <button class="btn btn-outline-dark float-end mt-4" data-bs-toggle="modal" data-bs-target="#Message">+ Add news</button>

                        </div>
                    </div>
  
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            {{$var}}
                        </div>
                        <div class="card-body">
                            <table id="ActiveStudents" class="cell-border compact stripe hover" >
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Message</th>
                                        <th>Posted at</th>
                                        <th class="text-center">Edit/Delete</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $item)
                                <tr>
                                <td>{{$item['id']}}</td>
                                <td>{{$item['Heading']}}</td>
                                <td>{{$item['message']}}</td>
                                <td>{{$item['posted_at']}}</td>
                                
                                {{-- <td><a href="edit/{{$item['s_id']}}" class="btn btn-outline-warning">Edit</a></td> --}}
                                <td class="text-center">
                                    
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button 
                                        data-id="{{$item['id']}}"  
                                        data-heading="{{$item['Heading']}}"  
                                        data-message="{{$item['message']}}"  
                                        data-posted_at="{{$item['posted_at']}}"  
                                     
                                        class="btn btn-outline-warning edit_btn">Edit</button>
                                        <a class="btn btn-outline-danger dlt_btn"  href="newsDelete"   data-id="{{$item['id']}}"  
                                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        onclick="update(this,{{$item['id']}})"
                                        >
                                            Delete
                                        </a>
                                        
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
                <form  id="Add_News" method="POST" >
                    @csrf

        
          
                    <div class="row mb-md-4">
                        <div class="form-group col-md-12  mb-3 mb-md-0">

                            <label for="heading">Heading</label>
                            <input type="text" class="form-control item" id="c_heading" name="heading" required>
                        </div>
                    </div>
         
                <div class="row mb-md-4">
                    <div class="form-group col-md-12  mb-3 mb-md-0">
                        <label for="News">News </label>
                        <textarea  cols="5" rows="8" class="form-control item" id="News" name="message" placeholder="type news here" required></textarea>
                    </div>
                </div>
                
            
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="sub">Post</button>
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
                <form  id="Edit_news" method="POST" >
                        @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row mb-md-4">
                        <div class="form-group col-md-12  mb-3 mb-md-0">

                            <label for="heading">Heading</label>
                            <input type="text" class="form-control item" id="heading" name="heading" required>
                        </div>
                    </div>
                    <div class="row mb-md-4">
                        <div class="form-group col-md-12  mb-3 mb-md-0">

                            <label for="Posted_at">Posted at</label>
                            <input type="datetime" class="form-control item" id="Posted_at" name="Posted_at" disabled required>
                        </div>
                    </div>

            
               
                    <div class="row mb-md-4">
                        <div class="form-group col-md-12  mb-3 mb-md-0">
                            <label for="News">News </label>
                            <textarea  cols="5" rows="8" class="form-control item" id="message" name="message" placeholder="type news here" required></textarea>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Do you really wanna Delete?
        </div>
        <div class="modal-footer">
        <form action="" method="post" name="form" id="DeleteNews">
            @csrf
            <input type="hidden" name="id" id="d_id" value="">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit"  class="btn btn-danger">Delete</button>
        </form>
        </div>
    </div>
    </div>
</div>

  
        <script>
    
          
$('.edit_btn').click(function(e) {
        e.preventDefault();
        
        var id = $(this).data('id');
        var message = $(this).data('message');
        var heading= $(this).data('heading');
        var posted_at = $(this).data('posted_at');


        // sending values to modal
        $('#id').val(id);
        $("#message").val(message);
        $("#heading").val(heading);
        $("#Posted_at").val(posted_at);
        
        $("#form_modal").modal('toggle');
        
    

    });



    $('#Edit_news').submit(function(e){
    
    $("#subedit").attr("disabled","disabled");
    e.preventDefault();

        form = $("#Edit_news");
        $.ajax({
            type : 'POST',
            url  : '/admin/newsUpdate',
            data : form.serialize(),
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
    $('#Add_News').submit(function(e){
    
        $("#sub").attr("disabled","disabled");
    e.preventDefault();

        form = $("#Add_News");
        
        $.ajax({
            type : 'POST',
            url  : '/admin/news',
            data : form.serialize(),
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

    // delete script here
    function update(ele,p) {
                action = $(ele).select();
                href = action.attr('href');
                
                // console.log(href);
                var forms = document.getElementById('DeleteNews')
                forms.setAttribute('action','/admin/'+href);


                var setValue = document.getElementById('d_id');
                setValue.setAttribute('value',p);

            }

            // submit delete here
    $("#DeleteNews").submit(function(e) {

        e.preventDefault();
        // return false;
        // avoid to execute the actual submit of the form.

        var form = $('#DeleteNews');
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