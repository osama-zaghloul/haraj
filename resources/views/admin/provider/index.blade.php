@extends('admin.include.master')
@section('title') لوحة التحكم | اضافة مطور @endsection
@section('PageName')
<h1>
  المطورين
  <small>Preview sample</small>
</h1>
@endsection 

@section('content')

<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">اضافة مطور</h3>
              </div>
              {{ Form::open(array('method' => 'POST','files' => true,'url' =>'adminpanel/provider' )) }}
                <div class="box-body">

                <div class="form-group col-md-6">
                    <label>اسم المستخدم</label>
                    <input type="text" class="form-control" required="required" name="username" value="{{ Request::old('username') }}">
                    @if ($errors->has('username'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('username') }}</div>
                    @endif
                    @if(session()->has('exituser'))
                    <div style="color: crimson;font-size: 18px;" class="error">{{ session('exituser')}}</div>
                    <?php session()->forget('exituser'); ?>
                    @endif 
                </div>

                <div class="form-group col-md-6">
                    <label>الصورة الشخصية</label>
                    <input type="file" class="form-control" required="required" name="image">
                    @if ($errors->has('image'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('image') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label> كلمة المرور </label>
                    <input type="password" id="adminpass1" class="form-control" required="required" name="pass" value="{{ Request::old('pass') }}">
                    <div>
                    <div style="color: crimson;font-size: 12px;display:none;background-color:crimson;padding:1%;" class="error" id="errorpass"></div>
                    <div class="figure" id="strength_human1"></div>
                    
                    </div>
                    @if ($errors->has('pass'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('pass') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label> اعادة كلمة المرور </label>
                    <input type="password" id="confirmadminpass1" class="form-control" required="required" name="repass" value="{{ Request::old('repass') }}">
                    <!--<div id="errorconfirm" style="color:crimson;font-size: 18px;" class="error"></div>-->
                    @if ($errors->has('repass'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('repass') }}</div>
                    @endif
                    <!--@if(session()->has('wrongpass') )-->
                    <!--<div style="color: crimson;font-size: 18px;" class="error">{{ session('wrongpass') }}</div>-->
                    <!--{{ session()->forget('wrongpass')}}-->
                    <!--@endif -->
                </div>


    <div class="box-footer">
        <button type="submit" class="btn btn-primary col-md-offset-4 col-md-4" >اضافة</button>
    </div>
    {!! Form::close() !!}
       </div>
</div> 



<div class="row">
    <div class="box">
        
        <!-- /.box-header -->
        <div class="table-responsive box-body">
            <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>اسم المطور </th>
                    <th>الصورة الشخصية </th>
                    <th>تعديل</th>
                    <th>حذف</th>
                </tr>
                </thead>
                <tbody>
                @foreach($providers as $provider)
                    <tr> 
                        <td>{{$provider->username}}</td>
                        <td>
                        <img class="img-circle" style="width:100px; height:100px;" src="{{asset('users/images/'.$provider->image)}}" alt="" >
                        </td>
                        <td> <a href='{{asset("adminpanel/provider/".$provider->id)}}/edit' class="btn btn-success"><i class="fa fa-pencil-square-o " aria-hidden="true"></i></a> </td>
                        <td>
                            {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('Are you Sure ?!')",'files' => true,'url' => array('adminpanel/provider/'.$provider->id))) }}
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true" fa-2x=""></i></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>        <!-- /.box-body -->
    </div>
</div>
@endsection 