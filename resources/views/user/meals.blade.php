@extends('layouts.app')

@section('content')

    <div class="container card shadow"  style="">
        <h1>Meals</h1>
    <div class="row">

        @foreach($meals as $meal)
            <div class="col-md-3">
                <div class="product-top">
                    <a href="{{ route('show.meal',$meal) }}"> <img src="/storage/{{ $meal->image }}" class="d-block w-100"> </a>

                </div>
                <div class="product-bottom text-center">
                    <h3>{{ $meal->name }}</h3>
                </div>
            </div>
        @endforeach
    </div>


</div>
@endsection
