@extends('admin/include/master')
@section('title') لوحة التحكم | إضافة منتج جديد @endsection
@section('content')

<section class="content">
        <div class="row">
                <div class="col-xs-12">
                <div class="box box-primary">

              <div class="box-header with-border">
                <h3 class="box-title">إضافة منتج جديد</h3>
              </div>
              
              {!! Form::open(array('method' => 'POST','files' => true,'url' =>'adminpanel/items')) !!}
                <div class="box-body">  
                
                  
                  
                  <div class="form-group col-md-6">
                    <label>اسم المنتج </label>
                    <input type="text" class="form-control" name="artitle" placeholder="ادخل اسم المنتج " value="{{ old('artitle') }}" required>
                    @if ($errors->has('artitle'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('artitle') }}</div>
                    @endif  
                  </div>
                  <div class="form-group col-md-6">
                        <label>صاحب المنتج</label>
                        <select class="form-control"  name="user_id" required>
                            <option value="0" disabled="" selected="">اختار المستخدم</option>
                            @foreach($allusers as $user)
                                <option value="{{$user->id}}"> {{$user->name}} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('user_id'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('user_id') }}</div>
                        @endif  
                    </div>
                  
                   <div class="form-group col-md-6">
                        <label>القسم</label>
                        <select class="form-control"  name="category_id" required>
                            <option value="0" disabled="" selected="">اختار القسم</option>
                            @foreach($allcats as $cat)
                                <option value="{{$cat->id}}"> {{$cat->name}} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('category_id') }}</div>
                        @endif  
                    </div>

                    <div class="form-group col-md-6">
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

                <div class="form-group col-md-6">
                                    <label>اختر المدينة</label>
                                    <div class="form-group col-md-12">
                                        <select name="city_id" id="city">
                                            <option value="">اختر المدينة</option>
                                            
                                        </select>
                                    </div>  
                      </div>
                    <div class="form-group col-md-6">
                      <label>رقم الواتس</label>
                      <input type="text" name="whatsapp" class="form-control" placeholder = 'رقم الواتس'>
                      @if ($errors->has('whatsapp'))
                          <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('whatsapp') }}</div>
                      @endif  
                  </div>

                  <div class="form-group col-md-6">
                      <label>رقم الهاتف</label>
                      <input type="text" name="phone" class="form-control" placeholder = 'رقم الهاتف'>
                      @if ($errors->has('phone'))
                          <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('phone') }}</div>
                      @endif  
                  </div>

                  <div class="form-group col-md-6">
                    <label>السعر [ريال]</label>
                    <input type="number" name="price" class="form-control" placeholder = 'ادخل السعر' required>
                    @if ($errors->has('price'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('price') }}</div>
                    @endif  
                  </div>
                  
                   

                  <div class="form-group col-md-6">
                      <label>صور اكثر عن الاعلان [يمكنك رفع اكثر من صورة]</label>
                      <input type="file" name="items[]" multiple>
                      @if ($errors->has('items'))
                          <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('items') }}</div>
                      @endif  
                  </div>

                  <div class="form-group col-md-6">
                      <label>فيديو الإعلان</label>
                      <input type="file" name="video" >
                      @if ($errors->has('video'))
                          <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('video') }}</div>
                      @endif  
                  </div>

                  <div class="col-md-12">
                      <div class="box box-info">
                          <div class="box-header">
                          <h3 class="box-title" > تفاصيل المنتج </h3>
                          </div>
                          <div class="box-body pad">
                              <textarea id="editor1" name="ardesc" rows="10" cols="167" required>{!! old('ardesc') !!}</textarea>
                              @if ($errors->has('ardesc'))
                                  <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('ardesc') }}</div>
                              @endif
                          </div>
                      </div>
                  </div>

                  
                    
                </div>
                
                <div class="box-footer">
                  <button style="width: 20%;margin-right: 40%;" type="submit" class="btn btn-primary">إضافة</button>
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
