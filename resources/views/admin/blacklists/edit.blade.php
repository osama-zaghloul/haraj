@extends('admin/include/master')
@section('title') لوحة التحكم | تعديل العضو في القائمة السوداء @endsection
@section('content')

    <section class="content">
            <div class="row">
                <div class="col-xs-12">  
                    <div class="box box-primary">
    
                    <div class="box-header with-border">
                        <h3 class="box-title">تعديل العضو في القائمة السوداء </h3>
                    </div>
                
                {!! Form::open(array('method' => 'patch','files'=> true ,'url' =>'adminpanel/blacklists/'.$blacklist->id)) !!}
                    <div class="box-body">

                       <div class="form-group col-md-6">
                                    <label>اختر العضو</label>
                                    <div class="form-group col-md-12">
                                        <select name="user_id" >
                                            <option value="">اختر العضو</option>
                                            @foreach ($users as $user)
                    
                                        <option @if($user->id == $blacklist->user_id) selected @endif value="{{$user->id}}">{{$user->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>  
                      </div>

                        <div class="form-group col-md-6">
                            <label> النص  </label>
                        <input type="text"  value="{{$blacklist->message}}" class="form-control" name="message" placeholder=" النص " value="{{ old('message') }}" >
                            @if ($errors->has('message'))
                                <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('message') }}</div>
                            @endif  
                        </div>
                        

                    </div>

                    <div class="box-footer">
                    <button style="width: 20%;margin-right: 40%;" type="submit" class="btn btn-success">تعديل</button>
                    </div>
                    {!! Form::close() !!}
            </div>
            </div>
    </section>
                            
@endsection 
