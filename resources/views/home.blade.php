<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>Laravel</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        body {
            font: 400 15px/1.8 Lato, sans-serif;
            color: #777;
        }
        h3, h4 {
            margin: 10px 0 30px 0;
            letter-spacing: 10px;
            font-size: 20px;
            color: #111;
        }
        .container {
            padding: 90px 120px;
        }

        .carousel-inner img {
            -webkit-filter: grayscale(10%);
            filter: grayscale(20%);
            width: 100%;
            margin: auto;
        }
        .carousel-caption h3 {
            color: #fff !important;
        }
        @media (max-width: 600px) {
            .carousel-caption {
                display: none;
            }
        }
        .bg-1 {
            background: #051d30;
            color: #bdbdbd;
        }
        .bg-1 h3 {color: #fff;}
        .bg-1 p {font-style: italic;}

        .navbar {
            font-family: Montserrat, sans-serif;
            margin-bottom: 0;
            background-color: #082330;
            border: 0;
            font-size: 11px !important;
            letter-spacing: 4px;
            opacity: 0.9;
        }
        .navbar li a, .navbar .navbar-brand {
            color: #d5d5d5 !important;
        }
        .navbar-nav li a:hover {
            color: #fff !important;
        }
        .navbar-nav li.active a {
            color: #fff !important;
            background-color: #2c0600 !important;
        }
        .navbar-default .navbar-toggle {
            border-color: transparent;
        }




        footer {
            background-color: #082330;
            color: #f5f5f5;
            padding: 32px;
        }
        footer a {
            color: #f5f5f5;
        }
        footer a:hover {
            color: #777;
            text-decoration: none;
        }
    </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">Smart Market</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#myPage">HOME</a></li>
                <li><a href="#user">User</a></li>
                <li><a href="#vendor">Vendor</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="{{asset('images/welcom.png')}}" width="1200" height="700">
            <div class="carousel-caption">
                <h3>Smart Market</h3>
                <p>Simplicity of use.</p>
            </div>
        </div>

        <div class="item">
            <img src="{{asset('images/welcomee.jpg')}}"  width="1200" height="700">
            <div class="carousel-caption">
                <h3>Our products</h3>
                <p>guaranteed to meet your requirements.</p>
            </div>
        </div>

        <div class="item">
            <img src="{{asset('images/welcomeee.jpg')}}" width="1200" height="700">
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
    <h3>User</h3>
    <p><em>Start shopping with us</em></p>
    <p>The site shows you the products in simple ways</p>
    <br>
    <br>



</div>

<!-- Container (TOUR Section) -->
<div id="vendor" class="bg-1">
    <div class="container text-center">
        <h3>Vendor</h3>
        <p><em>Start your business with us</em></p>
        <p>The site offers dealing in the simplest way</p>
        <br>
        <br>




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
            <p><span class="glyphicon glyphicon-envelope"></span> Email: smartMarket@gmail.com</p>
        </div>
    </div>
    <br>

</div>

<footer class="text-center">
    <br><br>

    <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </a><br><br>
    <p>Move to the top</p>
</footer>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>

</body>
</html>


