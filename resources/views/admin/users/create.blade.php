@extends('admin/include/master')
@section('title') لوحة التحكم | إضافة عضو جديد @endsection
@section('content')

<section class="content">
        <div class="row">
            <div class="col-xs-12">  
                <div class="box box-primary">
  
              <div class="box-header with-border">
                <h3 class="box-title">إضافة عضو جديد</h3>
              </div>
              
              {!! Form::open(array('method' => 'POST','files' => true,'url' =>'adminpanel/users')) !!}
                <div class="box-body">
                    
                <div class="form-group col-md-6">
                    <label>الاسم  </label>
                    <input type="text" class="form-control" name="name" placeholder="ادخل الاسم  " value="{{ old('name') }}" required>
                    @if ($errors->has('name'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('name') }}</div>
                    @endif  
                </div>
                

                <div class="form-group col-md-6">
                    <label>رقم الجوال</label>
                    <input type="text" class="form-control" name="phone" placeholder="ادخل رقم الجوال" value="{{ old('phone') }}" required>
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
                    
                                        <option value="{{$country->id}}">{{$country->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>  
                      </div>

                <div class="form-group col-md-12">
                                    <label>اختر المدينة</label>
                                    <div class="form-group col-md-12">
                                        <select name="city_id" id="city">
                                            <option value="">اختر المدينة</option>
                                            
                                        </select>
                                    </div>  
                      </div>


                <div class="form-group col-md-6">
                    <label> كلمة المرور</label>
                    <input type="password" class="form-control" id="adminpass1" name="pass" placeholder="كلمة المرور" required>
                    <div style="padding:1%;" id="errorpass"></div>
                    <div class="figure" id="strength_human2"></div>
                    @if ($errors->has('pass'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('pass') }}</div>
                    @endif  
                </div>
                   
                 <div class="form-group col-md-6">
                    <label> إعادة كلمة المرور</label>
                    <input type="password" class="form-control" id="confirmadminpass1" name="confirmpass" placeholder="إعادة كلمة المرور" required>
                    <!--<div style="color: crimson;font-size: 12px;display:none;" class="error" id="errorconfirm"></div>-->
                    @if ($errors->has('confirmpass'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('confirmpass') }}</div>
                    @endif  
                </div> 

                </div>

                <div class="box-footer">
                  <button style="width: 20%;margin-right: 40%;" type="submit"  class="btn btn-primary">إضافة</button>
                </div>
                <input type="hidden" id="base_url" value="<?php echo URL::to("/"); ?>">
                {!! Form::close() !!}
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

{{-- <script type="text/javascript">
var base_url = $("#base_url").val();
console.log(base_url);
    $('#country_id').change(function () {

        var country_id = $(this).val();


        $.ajax({
            method: "GET",
            url:base_url + "/adminpanel/list_cities",
            data: {country_id: country_id}
        }).done(function (cities) {

            $('#city_id').empty().trigger('change');
            $('#city_id').append("<option value=''>اختار المدينه</option>");
            $.each(cities, function (i, city) {
                $('#city_id').append("<option value='" + city.id + "'>" + city.name +  "</option>");
            });
        });
    });
</script> --}}
@endsection 
