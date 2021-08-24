@extends('layout')


@section('title')
    Soemthing went wrong
@endsection

@section('content')
    <x-navbar/>
    <section class="text-center  mt-5">
        @if ($data == 0)
            <main class="px-5 pt-5">
                <div class="container">

                    <div class="row">
                        {{-- <div class="col"></div> --}}
                        <div class="col-lg-12 col-md-12 ">
                            <div>
                                <h1 class="pt-5">
                                    <i class="fas fa-exclamation-circle fs-1 mb-4"></i><br>
                                    Wrong Email or Password.</h1>
                                <p class="lead">Please check either email/username or password is wrong.</p>
                            </div>
                        </div>
                        {{-- <div class="col"></div> --}}
                    </div>

                </div>
            </main>    
        @else
        <main class="px-5 pt-5">
            <h1><i class="fas fa-exclamation-circle fs-1 mb-4"></i><br>
                Something went wrong.</h1>
            <p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
        </main>    
        @endif
    </section>  
@endsection