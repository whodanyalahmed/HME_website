@extends('layout')

@section('title')
    Fee Payment | HME

@endsection

@section('content')
    
    <section class="d-flex justify-content-end">
        <main class="px-5 pt-5">
            <a href="logout" class="btn btn-danger">Logout</a>
        </main>
    </section>

    @if (session('user')['fee_status'] == 0)
    <section class="d-flex justify-content-center">
        <main class="px-5 ">
            <h1></h1>
            <h1 class="pt-5 text-center">
                <i style="font-size:90px;" class="fas fa-exclamation-circle text-warning my-4 "></i><br>
                Please pay the fees.</h1>
                <p class="lead">At this Account number XXXXXXXXXXXXXX and upload the screenshot here.</p>
                <p class="lead">
                <form action="upload" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control" accept="image/*" required><br>
                    <input type="submit" class="btn btn-outline-dark float-end">
                </form>
                </p>
          </main>    
    </section>
    @else 
    <section class="d-flex justify-content-center">
        <main class="px-5 ">
            <h1></h1>
            <h1 class="pt-5 text-center">
                <i style="font-size:90px;" class="fas fa-hourglass-half text-warning my-4 "></i><br>
                Please wait till you get confirm after verification.</h1>
                <p class="lead text-center">If you still in pending then please contact on this number 03XX-XXXXXXX.</p>

          </main>    
    </section>
        
    @endif
    
@endsection