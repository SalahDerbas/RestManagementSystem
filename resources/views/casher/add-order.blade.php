@extends('layouts.casher3')

@section('content')
    <div class="container-fluid " style="background-image: url({{asset('images/casher.jpg')}});
        height: 800px;
        width: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;">
        <div class="row ">
            <div class="col-md-5 mt-5 ml-5">
                <div class="card bg-transparent border-0" style="height: 500px;">
                    <div class="card-header bg-white border-0 text-center ">

                        <div class="card-body ">
                            <form method="POST" action="{{ route('casher.store.order',$reservation) }}">
                                @csrf
                                <div class=" border-0 pt-1 pb-3">
                                    <h2 class="text-center">{{ __('Add Order') }}</h2>

                                </div>
                                @foreach($categories as $category)
                                <div class="form-group row">
                                    <label for="dob" class="col-md-4 col-form-label text-md-right"
                                    >{{ $category->name }}</label>

                                    <div class="col-md-6">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{$category->name}}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                @foreach($category->meals as $meal)

                                                   <li class="dropdown-item" > <input type="checkbox" id="{{$meal->id}}" name="meals[]" value="{{$meal->id}}"/> <label for="{{$meal->id}}" > {{$meal->name}}</label>
                                                   </li>  @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endforeach

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-2">
                                        <button type="submit" class="btn btn-primary" style="width: 100%">
                                            {{ __('Add Order') }}
                                        </button>

                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
