@extends('front.include.homemaster')
@section('title') {{__('messages.faztrade')}}  | {{__('messages.resetpass2')}}    @endsection
@section('content')

    <div class="pages">
        <div class="register_page">
            <div class="container">
            <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label for="basic-url">{{__('messages.email')}}</label>
                            <div class="input-group mb-3">
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  placeholder="{{__('messages.email')}}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3"></div>

                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label for="basic-url">{{__('messages.newpass')}}</label>
                            <div class="input-group mb-3">
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3"></div>

                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label for="basic-url">{{__('messages.confirmnewpass')}}</label>
                            <div class="input-group mb-3">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="col-md-3"></div>

                        <div class="col-md-12 text-center">
                            <div class="btn_form">
                                <button class="">{{__('messages.save')}}</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
