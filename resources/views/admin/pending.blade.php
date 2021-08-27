@extends('layout')


@section('title')
    Pending | Admin
@endsection 

@section('content')
<body class="sb-nav-fixed">
    <x-dash-side-nav data="Pending Students"/>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Pending Students</h1>
                    
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