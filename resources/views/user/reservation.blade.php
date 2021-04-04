@extends('layouts.app')

@section('content')
    <div class="container-fluid " style="background-image: url({{asset('images/chef2.jpg')}});
    height: 500px;
    width: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        ">
        <div class="row pt-5" style="padding-right: 300px">
            <div class="col-md-8 "></div>
            <div class="col-md-4 ">
                <div class="card">
                    <div class="card-header" style="">{{ __('Reserve') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('reserve') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="date" class="col-md-4  col-form-label ">{{ __('Date') }}</label>

                                <div class="col-md-8">
                                    <div class="container">
                                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                            <input type="datetime-local" class="form-control" id="date" name="date">
                                        </div>
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="number" class="col-md-6 col-form-label ">{{ __('Persons Number') }}</label>

                                <div class="col-md-4">
                                    <input id="number" type="number" min="1" class="form-control @error('number') is-invalid @enderror" name="number" required >

                                    @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-warning w-100">
                                        {{ __('Reserve') }}
                                    </button>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
