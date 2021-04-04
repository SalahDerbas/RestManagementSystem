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
                            <form method="POST" action="{{ route('casher.update.order',$order) }}">
                                @csrf
                                <div class=" border-0 pt-1 pb-3">
                                    <h2 class="text-center">{{ __('Edit Order') }}</h2>

                                </div>
                                <div class="form-group row">
                                    <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('quantity') }}</label>

                                    <div class="col-md-6">
                                        <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity')??$order->quantity }}" required autocomplete="quantity" autofocus>

                                        @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-2">
                                        <button type="submit" class="btn btn-primary" style="width: 100%">
                                            {{ __('Edit Order') }}
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
