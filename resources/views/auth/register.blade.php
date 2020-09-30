@extends('front.include.homemaster')
@section('title') {{__('messages.faztrade')}} | {{__('messages.register')}} @endsection
@section('content')
<div class="clearfix"></div>

<div class="bar_title">
    <div class="container">
        <span><a href="{{asset('/')}}">{{__('messages.home')}} /</a></span> 
        <span>{{__('messages.register')}} </span>
    </div>
</div>

<div class="pages">
        <div class="register_page">
            <div class="container">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="basic-url">{{__('messages.username')}}</label>
                            <div class="input-group mb-3">
                                <input type="text" placeholder="{{__('messages.username')}}" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="basic-url">{{__('messages.email')}}</label>
                            <div class="input-group mb-3">
                                <input type="email" placeholder="{{__('messages.email')}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="basic-url">{{__('messages.country')}}</label>
                            <div class="input-group mb-3">
                                <select id="country" name="country" class="{{ $errors->has('country') ? ' is-invalid' : '' }}"  required>
                                    <option value="" disabled selected>{{__('messages.choose')}} {{__('messages.country')}}</option>
                                    @foreach($allcounts as $country)
                                        <option value="{{$country->id}}">{{session('locale') == 'en' ? $country->enname : $country->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="basic-url"> {{__('messages.city')}}</label>
                            <div class="input-group mb-3">
                            <select id="area" name="city" class="{{ $errors->has('city') ? ' is-invalid' : '' }}"  required>
                                <option value="0" disabled="" selected="">{{__('messages.choose')}} {{__('messages.city')}}</option>
                            </select>
                            @if ($errors->has('city'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="basic-url"> {{__('messages.phone')}}</label>
                            <div class="input-group mb-3 numer_inp">
                                <input type="number" placeholder="{{__('messages.phone')}}" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="basic-url">{{__('messages.password')}}</label>
                            <div class="input-group mb-3">
                                <input type="password" placeholder="{{__('messages.password')}}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="basic-url">{{__('messages.confirmpass')}}</label>
                            <div class="input-group mb-3">
                                <input type="password" placeholder="{{__('messages.confirmpass')}}" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="basic-url">{{__('messages.uploadimg')}}</label>
                            <div class="input-group mb-3">
                                <input id="files" type="file" class="form-control" name="image" placeholder="{{__('messages.uploadimg')}}" required>
                                @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div id="selectedFiles"></div>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="btn_form">
                                <button class="">{{__('messages.register')}}</button>
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <a href="{{asset('/login')}}">{{__('messages.haveaccount2')}}</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
</div>

<div class="clearfix"></div>
@endsection
