@extends('layouts.casher3')

@section('content')
    <div class="container-fluid " style="background-image: url({{asset('images/casher.jpg')}});
        height: 800px;
        width: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;">
        <div class="row ">
            <div class="col-md-6 mt-5 ml-5">
                <div class="card bg-transparent border-0" style="height: 500px;">
                    <div class="card-header bg-white border-0 text-center ">

                        <div class="card-body ">
                            <form method="POST" action="{{ route('casher.update.report',$report) }}">
                                @csrf
                                <div class=" border-0 pt-1 pb-3">
                                    <h2 class="text-center">{{ __('Add Report') }}</h2>

                                </div>
                                <div class="form-group row">
                                    <label for="income"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Income') }}</label>

                                    <div class="col-md-8">
                                        <input type="text" id="income" value="{{ old('income')??$report->income }}"
                                               class="form-control @error('income') is-invalid @enderror" name="income"
                                               required autocomplete="income" autofocus>


                                        @error('income')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="content"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Days') }}</label>

                                    <div class="col-md-8">
                                        <input id="days_off" type="text" value="{{ old('days_off')??$report->days_off }}"
                                               class="form-control @error('days_off') is-invalid @enderror"
                                               name="days_off" required autocomplete="days_off" autofocus>
                                        @error('days_off')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="content"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Notes') }}</label>

                                    <div class="col-md-8">
                                        <textarea id="content" rows="8" cols="20"
                                                  class="form-control @error('content') is-invalid @enderror"
                                                  name="content" required autocomplete="content" autofocus>
                                            {{$report->content}}
                                        </textarea>

                                        @error('content')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-2">
                                        <button type="submit" class="btn btn-primary" style="width: 100%">
                                            {{ __('Edit') }}
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
