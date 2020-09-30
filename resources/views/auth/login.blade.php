@extends('front.include.homemaster')
@section('title') {{__('messages.faztrade')}} | {{__('messages.login')}} @endsection
@section('content')

    <div class="bar_title">
        <div class="container">
            <span><a href="{{asset('/')}}">{{__('messages.home')}} /</a></span>  
            <span>{{__('messages.login')}}</span>
        </div>
    </div>

    <div class="pages">
        <div class="register_page">
            <div class="container">
            <form method="POST" action="{{ route('login') }}">
            @csrf
                    <div class="row">
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

                        <div class="col-md-6">
                            <label for="basic-url">{{__('messages.password')}}</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{__('messages.password')}}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="btn_form">
                                <button class="">{{__('messages.login')}}</button>
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <a href="{{ route('register') }}">{{__('messages.haveaccount')}}</a>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">{{__('messages.forgetpass')}}</a>
                            @endif
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
