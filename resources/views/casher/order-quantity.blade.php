@extends('layouts.casher3')

@section('content')
    <div class="container">

        <form method="get" action="{{url('casher/order/store/quantity/'.json_encode($orders))}}">
            @csrf
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Meal</th>
                <th scope="col">Quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $k=>$order)
            <tr>
                <th scope="row">{{$k}}</th>
                <td>{{$order->meal->name}}</td>
                <td><input type="text" name="numbers[]"></td>

            </tr>
            @endforeach

            </tbody>
        </table>
        <div class="form-group row mb-0">
        <div class="col-md-8 ">
            <button type="submit" class="btn btn-primary">
                {{ __('Complete') }}
            </button>
        </div>

         </div>

        </form>
    </div>


@endsection
