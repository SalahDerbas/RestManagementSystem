@extends('layouts.admin')

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
    <div class="text-center"><h2>Monthly Income</h2></div>
    <!-- Container (The Band Section) -->
    <div id="chart" style="height: 300px;"></div>
    <!-- Charting library -->
    <div class="text-center"><h2>This Month Income</h2></div>
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Day</th>
                    <th scope="col">Income</th>
                    <th scope="col">Outcome</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
<?php $j=0; $k=0;?>
                @for($i=1;$i<32;$i++)
                <tr>
                    <th scope="row">{{$i}}</th>
            <?php $total = 0;?>
                    @if( $j<sizeof($values)&&date('d', strtotime($values[$j]['created_at'])) == $i)
                    <td>{{$values[$j]['total']}}</td>
                    {{sizeof($values)}}
                        <?php $total= $values[$j]['total'];  $j++;?>
                    @else <td>0</td>
                    @endif

                    @if(  $k<sizeof($outcomes)&&date('d', strtotime($outcomes[$k]['created_at'])) == $i)
                    <td>{{$outcomes[$k]['total']}}</td>

                    <?php
                        if($total == 0){
                            $total = -$outcomes[$k]['total'];
                        }
                        else{
                            $total = $total - $outcomes[$k]['total'];
                        }
                        $k++;
                    ?>
                   @else <td>0</td>
                        @endif

                    <td>{{$total}}</td>
                </tr>
                @endfor

                </tbody>
            </table>


        </div>
    </div>
</div>

    <!-- Your application script -->
    <script>
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('sample_chart')",
            hooks: new ChartisanHooks()
                .colors(['#cd8916'])

        });
    </script>

    <!-- Container (TOUR Section) -->
    <div id="vendor" class="bg-1">
        <div class="container text-center">
            <h3>Meals</h3>
            <p><em>our meals is The best</em></p>

            <br>
            <br>


            <a class="btn btn-outline-warning" style="color: #000;" href="{{route('admin.meals')}}">View</a>
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


