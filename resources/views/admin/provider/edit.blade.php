@extends('admin.include.master')
@section('title') لوحة التحكم | تعديل مطور @endsection
@section('PageName')
<h1>
  المطورين
  <small>Preview sample</small>
</h1>
@endsection 

@section('content')

<div class="box box-primary">
@if(session()->has('updatedpass'))
    <div class="alert alert-success">
      <strong>congratulations!</strong> {{ session('updatedpass') }}
    </div>
    <?php session()->forget('updatedpass'); ?>
    @endif 
              <div class="box-header with-border">
                <h3 class="box-title">تعديل بيانات مطور</h3>
              </div>
              {{ Form::open(array('method' => 'patch','files' => true,'url' =>"adminpanel/provider/$edprovider->id" )) }}
                <div class="box-body">

              <div class="col-md-6">
              <h3 class="box-title"> {{$edprovider->username}}</h3>
                  <div class="col-md-12">
                      <img class="img-thumbnail" style="width:100%; height:50%;" src="{{asset('users/images/'.$edprovider->image)}}" alt="">
                </div>
              </div>

              <div class="col-md-6">
        
                <div class="form-group col-md-12">
                    <label>كلمة المرور الجديدة</label>
                    <input type="password" id="adminpass1" class="form-control" name="pass" >
                    @if ($errors->has('pass'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('pass') }}</div>
                    @endif
                    <div style="color: crimson;font-size: 12px;display:none;background-color:crimson;padding:1%;" class="error" id="errorpass"></div>
                    <div class="figure" id="strength_human1"></div>
                </div>

                <div class="form-group col-md-12">
                    <label>اعادة كلمة المرور  </label>
                    <input type="password" id="confirmadminpass1" class="form-control"  name="repass">
                    <!--<div id="errorconfirm" style="color:crimson;font-size: 18px;" class="error"></div>-->
                    @if ($errors->has('repass'))
                      <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('repass') }}</div>
                    @endif
                </div>

              </div>


    <div class="box-footer">
        <button type="submit"   class="btn btn-primary col-md-offset-4 col-md-4">update</button>
    </div>
    {!! Form::close() !!}
       </div>
</div> 

@endsection 