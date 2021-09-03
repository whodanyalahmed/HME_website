@extends('layout')

@php
    $var = "St. Fee Details"
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
                    {{-- <div class="row">
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
                            <table id="ActiveStudents" class="cell-border compact stripe hover" >
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>fee status</th>
                                        <th>Fee Paid</th>
                                        <th>Month</th>
                                        <th>year</th>
                                        <th>View</th>
                                        {{-- <th>Qualification</th>
                                        <th>Onsite</th> --}}
                                        <th>Interested in</th>
                                        <th>Not Paid/Pending/Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $item)
                                <tr>
                                <td>{{$item['s_id']}}</td>
                                <td>{{$item['s_name']}}</td>
                                {{-- <td>{{$item['s_co_id']}}</td> --}}
                                <td>{{$item['s_email']}}</td>
                                {{-- <td>{{($item['s_status']) ? "yes" : "no"}}</td> --}}
                                {{-- <td>{{$item['s_joined_date']}}</td> --}}
                                @php
                                $d = $item['fee_status'];
                                $s = ($d == 0) ? "not paid" : (($d == 1)  ? "paid" : "pending");
                                @endphp
                                <td>{{$s}}
                                </td>
                                <td>{{($item['fees_paid']) ? "Yes" : "No"}}</td>
                                {{-- <td>{{($item['onsite']) ? "yes" : "no"}}</td> --}}
                                <td>{{$item['monthname']}}</td>
                                <td>{{$item['year']}}</td>
                                <td><a href="{{$item['url']}}"  onclick="updateView(this)" data-bs-toggle="modal" data-bs-target="#view">View</a></td>
                                <td>{{$item['name']}}</td>
                                {{-- <td><button 
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
                                    data-sub_interest_id="{{$item['sub_interest_id']}}"   --}}
                                    {{-- href="edit/{{$item['s_id']}}" 
                                    class="btn btn-outline-success edit_btn"
                                    type="button"
                                    >
                                    Edit</button></td> --}}
                                <td>
                                    <div class="btn-group d-flex justify-content-center" role="group" aria-label="Basic mixed styles example">
                                        <a href="notpaid/{{$item['s_id']}}"   onclick="update(this,{{$item['s_id']}})" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-danger">Not Paid</a>
                                        <a href="pending/{{$item['s_id']}}"   onclick="update(this,{{$item['s_id']}})" data-bs-toggle="modal" data-bs-target="#Pending" class="btn btn-outline-warning">Pending</a>
                                        <a href="paid/{{$item['s_id']}}"   onclick="update(this,{{$item['s_id']}})" data-bs-toggle="modal" data-bs-target="#Paid" class="btn btn-outline-success">Paid</a>
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
        <!-- Not paid Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Conirm disable</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you really wanna Not Paid?
                    </div>
                    <div class="modal-footer">
                        <form action="" method="post" id="form" name="form" class="form">
                            @csrf
                            <input type="hidden" name="id" id="formVal" value="">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="delete" class="btn btn-danger">Not Paid</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Modal -->
        <div class="modal fade" id="Pending" tabindex="-1" aria-labelledby="PendingLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="PendingLabel">Conirm disable</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you really wanna Pending?
                    </div>
                    <div class="modal-footer">
                        <form action="" method="post" id="form" name="form" class="form">
                            @csrf
                            <input type="hidden" name="id" id="formVal" value="">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="delete" class="btn btn-warning">Pending</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Paid Modal -->
        <div class="modal fade" id="Paid" tabindex="-1" aria-labelledby="PaidLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="PaidLabel">Conirm disable</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you really wanna Paid?
                    </div>
                    <div class="modal-footer">
                        <form action="" method="post" id="form" name="form" class="form" >
                            @csrf
                            <input type="hidden" name="id" id="formVal" value="">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="delete" class="btn btn-success">Paid</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Image Modal --}}
        <!-- Modal -->
<div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewLabel">Paid Screenshot</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <h3 id="cantfind"></h3>
        <img src="" alt="paid screenshot" id="Imgview" height="100%" width="100%">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
        <script>
            
          function updateView(ele){
            action = $(ele).select();
            href = action.attr('href');
            
            url = "/uploads/"+href;

            if(href == ""){
                document.getElementById("cantfind").setAttribute("class","");
                document.getElementById("cantfind").innerHTML = "<div class='alert alert-warning d-flex align-items-center container' role='alert' ><i class='fas fa-exclamation-circle mr-3'></i> Image is not Uploaded...</div>";
                document.getElementById("Imgview").setAttribute("class","hidden");
            }
            else{
                document.getElementById("cantfind").setAttribute("class","hidden");
                document.getElementById("Imgview").setAttribute("src",url);
                document.getElementById("Imgview").setAttribute("class","");
            }
            // alert(url);
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


            $(".form").submit(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $('.form');
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