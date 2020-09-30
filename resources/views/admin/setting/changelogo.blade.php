@extends('admin.include.master')
@section('title') لوحة التحكم | اعدادات التطبيق @endsection
@section('content')

<section class="content">
        <div class="row">
        <div class="col-md-12">
        <div class="box-header">
                <h3 class="box-title">اعدادات التطبيق</h3>
            </div>  
                <div class="box">
                    {{ Form::open(array('method' => 'PATCH','files' => true,'url' =>'adminpanel/setapp/'.$changelogo->id )) }}
                        <input type="hidden" name="addbrand">
                        <div class="box-body">

                        <div class="form-group col-md-6">
                            <label>لوجو  التطبيق</label>
                            <input style="width:100%;" type="file" class="form-control" name="logo">
                            @if ($errors->has('logo'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('logo') }}</div>
                            @endif
                        </div>

      
                         <div class="form-group col-md-6">
                            <label>صورة لوجو  التطبيق </label>
                            <div style="margin-bottom: 0;" class="login-logo">
                                <img class="img-thumbnail" style="height: 10%;" src="{{asset('users/images/'.$changelogo->logo)}}" alt="Logo"><br>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>  فيسبوك</label>
                        <input style="width:100%;" type="text" value="{{$changelogo->facebook}}" class="form-control" name="facebook">
                            @if ($errors->has('facebook'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('facebook') }}</div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>تويتر</label>
                            <input style="width:100%;" type="text" value="{{$changelogo->twitter}}" class="form-control" name="twitter">
                            @if ($errors->has('twitter'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('twitter') }}</div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>انستجرام</label>
                            <input style="width:100%;" type="text" value="{{$changelogo->instgram}}" class="form-control" name="instgram">
                            @if ($errors->has('instgram'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('instgram') }}</div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>سناب شات</label>
                            <input style="width:100%;" type="text" value="{{$changelogo->snapchat}}" class="form-control" name="snapchat">
                            @if ($errors->has('snapchat'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('snapchat') }}</div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>يوتيوب</label>
                            <input style="width:100%;" type="text" value="{{$changelogo->youtube}}" class="form-control" name="youtube">
                            @if ($errors->has('youtube'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('youtube') }}</div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>واتس آب</label>
                            <input style="width:100%;" type="text" value="{{$changelogo->whatsapp}}" class="form-control" name="whatsapp">
                            @if ($errors->has('whatsapp'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('whatsapp') }}</div>
                            @endif
                        </div>

                         <div class="form-group col-md-6">
                            <label>  نص حساب العمولة</label>
                            
                         <textarea style="width:100%;" class="form-control" name="commission_text" id="" cols="30" rows="10">{{$changelogo->commission_text}}</textarea>
                            @if ($errors->has('commission_text'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('commission_text') }}</div>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>  نص القائمة السوداء </label>
                            <textarea style="width:100%;" class="form-control" name="black_list" id="" cols="30" rows="10">{{$changelogo->black_list}}</textarea>
                            @if ($errors->has('black_list'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('black_list') }}</div>
                            @endif
                        </div>


                        <div style="padding: 24px;" class="box-footer col-md-offset-4 col-md-4">
                            <button type="submit" class="btn btn-primary col-md-12">تغيير</button>
                        </div>
                    {!! Form::close() !!}
                    </div>
                </div> 
        </div>
        </div>
</section>
<section class="content">
        <div class="row">
        <div class="col-md-12">
            <div class="box-header">
                <h3 class="box-title">ارسال الاشعارات لجميع المستخدمين</h3>
            </div>  
                   <div class="box box-danger">
                    {{ Form::open(array('method' => 'POST','url' =>'adminpanel/setapp')) }}
                        <div class="box-body">

                        <div class="form-group col-md-12">
                        <label>محتوى الاشعار</label>
                            <input style="width:100%;" type="text" class="form-control" name="notification">
                            @if ($errors->has('notification'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('notification') }}</div>
                            @endif
                        </div>
                        
                        <div style="padding: 24px;" class="box-footer col-md-offset-4 col-md-4">
                            <button type="submit" class="btn btn-primary col-md-12">ارسال</button>
                        </div>
                    {!! Form::close() !!}
                    </div>
                </div> 
        </div>
        </div>
</section>

@endsection