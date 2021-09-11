@extends('layout')

@section('title')
    Fee Payment | {{ $siteTitle }}

@endsection

@section('content')
    <div class="container">

        <section class="d-flex justify-content-end">
            <main class="px-5 pt-3">
                <a href="logout" class="btn btn-danger">Logout</a>
            </main>
        </section>

        @if (session('user')['fee_status'] == 0)
        <section class="d-flex justify-content-center">
            <main class="px-5 ">
                <h1>Hello! <strong><span class="fw-bolder" style="text-transform: uppercase">{{session('user')['name']}}</span></strong></h1>
                <h1 class="text-center">
                    {{-- <i style="font-size:90px;" class="fas fa-exclamation-circle text-warning my-4 "></i> --}}
                    
                    <img src="\assets\img\money.svg" height="350vh" width="350vw" alt="transfer money">
                    <br>
                    Please pay the fees <strong>Rs.{{session('user')["payable_fee"]}}/=</strong>.</h1>
                    <p class="lead">At this <br><span class="fw-bold">Account number: {{$Accountnno}}<br> 
                        Bank: {{$Bank_name}}<br> Account Holder: {{$Account_holder}}</span> <br>and upload the screenshot here.</p>
                    <p class="lead">
                    <form action="upload" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control" accept="image/*" required><br>
                        <input type="submit" class="btn btn-outline-dark float-end">
                    </form>
                    </p>
            </main>    
        </section>
    
    </div>
    @else 
    <section class="d-flex justify-content-center">
        <main class="px-5 ">
            <h1></h1>
            <h1 class="pt-5 text-center">
                <img src="\assets\img\time.svg" height="350vh" width="350vw" alt="waiting">
                
                {{-- <i style="font-size:90px;" class="fas fa-hourglass-half text-warning my-4 "></i> --}}
                <br>
                Please wait till you get confirm after verification.</h1>
                <p class="lead text-center">If you still in pending then please contact on this number 03XX-XXXXXXX.</p>

          </main>    
    </section>
        
    @endif
    
@endsection