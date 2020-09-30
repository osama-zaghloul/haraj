@extends('admin/include/master')
@section('title') لوحة التحكم | تعديل بيانات العضو @endsection
@section('content')
   
<section class="content">
    <div class="row">
      <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">تعديل بيانات العضو </h3>
          <p> {{ $eduser->name }} </p>
        </div>
        
        {!! Form::open(array('method' => 'patch','files' => true,'url' =>'adminpanel/users/'.$eduser->id)) !!}
        <div class="box-body">

                <div class="form-group col-md-6">
                    <label>الاسم  </label>
                    <input type="text" class="form-control" name="name" placeholder="ادخل الاسم  " value="{{$eduser->name}}" required>
                    @if ($errors->has('name'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('name') }}</div>
                    @endif  
                </div>
                
                <div class="form-group col-md-6">
                    <label>رقم الجوال</label>
                    <input type="text" class="form-control" name="phone" placeholder="ادخل رقم الجوال" value="{{ $eduser->phone }}" required>
                    @if ($errors->has('phone'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('phone') }}</div>
                    @endif  
                </div>

               <div class="form-group col-md-12">
                                    <label>اختر الدولة</label>
                                    <div class="form-group col-md-12">
                                        <select name="country_id" id="country">
                                            <option value="">اختر الدولة</option>
                                            @foreach ($countries as $country)
                    
                                        <option @if($eduser->country_id == $country->id)  selected @endif value="{{$country->id}}">{{$country->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>  
                      </div>

                <div class="form-group col-md-12">
                                    <label>اختر المدينة</label>
                                    <div class="form-group col-md-12">
                                        <select name="city_id" id="city">
                                            <option value="">اختر المدينة</option>
                                            @foreach ($cities as $city)
                    
                                        <option  @if($eduser->city_id == $city->id)   selected @endif value="{{$city->id}}">{{$city->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>  
                      </div>

                <div class="form-group col-md-6">
                    <label> كلمة المرور الجديدة</label>
                <input type="password"  class="form-control" id="adminpass1" name="pass" placeholder="كلمة المرور الجديدة">
                    <div style="padding:1%;" id="errorpass"></div>
                    <div class="figure" id="strength_human2"></div>
                    @if ($errors->has('pass'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('pass') }}</div>
                    @endif  
                </div>
                 <div class="form-group col-md-6">
                    <label>إعادة كلمة المرور الجديدة  </label>
                    <input type="password" class="form-control"  name="confirmpass" placeholder="إعادة كلمة المرور الجديدة" >
                    @if ($errors->has('confirmpass'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('confirmpass') }}</div>
                    @endif  
                </div> 

          </div>

          <div class="box-footer">
            <button style="width: 20%;margin-right: 40%;" type="submit" class="btn btn-success">تعديل</button>
          </div>
          {!! Form::close() !!}
        </div> 
      </div>  
    </div> 
</section>     
<script type="text/javascript">
        $("#country").change(function(){
            $.ajax({
                url: "{{ route('admin.list_cities') }}?country_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#city').html(data.html);
                }
            });
        });
   </script>                     
@endsection 
