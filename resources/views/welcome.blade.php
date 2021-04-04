@extends('layouts.user')

@section('content')

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{asset('images/k1.jpg')}}" width="1200" height="700">
                <div class="carousel-caption">
                    <h1 style="">Restaurant</h1>
                    <p>The best</p>
                </div>
            </div>

            <div class="item">
                <img src="{{asset('images/k2.jpg')}}"  width="1200" height="700">
                <div class="carousel-caption" >
                    <h1 >Our Meals</h1>
                    <p>guaranteed to meet your requirements.</p>
                </div>
            </div>

            <div class="item">
                <img src="{{asset('images/k3.jpg')}}" width="1200" height="700">
                <div class="carousel-caption">
                    <p>Speed in fulfilling requests.</p>
                </div>
            </div>

            <div class="item">
                <img src="{{asset('images/k4.jpg')}}" width="1200" height="700">
                <div class="carousel-caption">
                    <p>Speed in fulfilling requests.</p>
                </div>
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Container (The Band Section) -->
    <div id="user" class="container text-center">
        <h3>Welcome</h3>
        <p><em>Reserve in our restaurant</em></p>

        <br>
        <br>

        <a class="btn btn-warning" style="color: #000;" href="{{route('reservation')}}">Reserve</a>

    </div>

    <!-- Container (TOUR Section) -->
    <div id="vendor" class="bg-1">
        <div class="container text-center">
            <h3>Meals</h3>
            <p><em>our meals is The best</em></p>

            <br>
            <br>


            <a class="btn btn-outline-warning" style="color: #000;" href="{{route('meals')}}">View</a>

        </div>

    </div>

    <!-- Container (Contact Section) -->
    <div id="contact" class="container">
        <h3 class="text-center">Contact</h3>
        <br>
        <div class="row">
            <div class="col-md-4">
                <p><span class="glyphicon glyphicon-map-marker"></span> Syria</p>
                <p><span class="glyphicon glyphicon-phone"></span> Phone: 0900000000</p>
                <p><span class="glyphicon glyphicon-envelope"></span> Email: test@gmail.com</p>
            </div>
        </div>
        <br>

    </div>


@endsection


