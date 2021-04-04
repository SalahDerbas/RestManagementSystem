
@extends('layouts.app')

@section('content')

    <section class="single-product" style="background-image: url({{asset('images/bg1.jpg')}});
        height: 800px;
        width: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        ">
        <div class="container" >
            <div class="row">
                <div class="col-md-5 mt-4 ml-2 ">
                    <img src="/storage/{{ $meal->image }}" class="d-block w-100 rounded">
                </div>
                <div class="col-md-6">
                    <div class="row text-center">
                        <div class="col-md-4 mt-4 card rounded-right" >
                            <h2 style="color: #cd8916;">{{$meal->name}}</h2>
                        </div>
                    </div>
                    <br/>
                    <div class="row text-center">
                        <div class="col-md-4 card rounded-pill" >
                            <h4 >{{$meal->category->name}}</h4>
                        </div>
                    </div>
                    <br/>
                    <div class="row text-center">
                        <div class="col-md-4 card rounded-pill">
                            <h4 >Price: {{$meal->price}} S.P</h4>
                        </div>
                    </div>
                    <br/>
                    <div class="row ">
                        <div class="col-md-4">
                            <h4>Description: </h4>
                            <h5>{{ $meal->description }}</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection
