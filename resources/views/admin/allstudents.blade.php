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
                                        <a href="edit/{{$item['s_id']}}" class="btn btn-outline-warning">Edit</a>
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
        <script>
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
                success: function(data)
                {
                    location.reload();
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
                success: function(data)
                {
                    location.reload();
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