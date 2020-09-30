@extends('front.include.homemaster')
@section('title') {{__('messages.faztrade')}}  | {{__('messages.resetpass')}} @endsection
@section('content')

    <div class="pages">
        <div class="register_page">
            <div class="container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
            @csrf
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label for="basic-url">{{__('messages.email')}}</label>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{__('messages.email')}}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3"></div>

                        <div class="col-md-12 text-center">
                            <div class="btn_form">
                                <button class="">{{__('messages.sendnow')}}</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
