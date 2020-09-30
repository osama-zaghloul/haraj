@extends('admin/include/master')
@section('title') لوحة التحكم | تعديل بيانات المنتج @endsection
@section('content')

<section class="content">
    <div class="row">
      <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">تعديل بيانات المنتج </h3>
          <p> {{ $editem->title}} </p>
        </div>
         
        {!! Form::open(array('method' => 'patch','files' => true,'url' =>'adminpanel/items/'.$editem->id)) !!}
        <div class="box-body">
            
                  <div class="form-group col-md-6">
                    <label>كود المنتج</label>
                    <input type="text" class="form-control" name="code" disabled placeholder="ادخل كود المنتج" value="{{ $editem->id }}" required>
                    @if ($errors->has('code'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('code') }}</div>
                    @endif  
                  </div>
                  
                  <div class="form-group col-md-6">
                    <label>اسم المنتج </label>
                    <input type="text" class="form-control" name="artitle" placeholder="ادخل اسم المنتج  " value="{{ $editem->artitle }}" required>
                    @if ($errors->has('artitle'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('artitle') }}</div>
                    @endif  
                  </div>
                  <div class="form-group col-md-6">
                        <label>الاقسام</label>
                        <select class="form-control"  name="category_id" required>
                            <option value="0" disabled="">اختار القسم</option>
                            @foreach($allcats as $cat)
                                <option value="{{$cat->id}}" @if($cat->id == $editem->category_id) selected @endif> {{$cat->name}} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('category_id') }}</div>
                        @endif  
                  </div>
                  <div class="form-group col-md-6">
                        <label>صاحب المنتج</label>
                        <select class="form-control"  name="user_id" required>
                            <option value="0" disabled="" selected="">اختار المستخدم</option>
                            @foreach($allusers as $user)
                                <option @if($user->id == $editem->user_id) selected @endif value="{{$user->id}}"> {{$user->name}} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('user_id'))
                            <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('user_id') }}</div>
                        @endif  
                    </div>

                   <div class="form-group col-md-6">
                                    <label>اختر الدولة</label>
                                    <div class="form-group col-md-12">
                                        <select name="country_id" id="country">
                                            <option value="">اختر الدولة</option>
                                            @foreach ($countries as $country)
                    
                                        <option @if($editem->country_id == $country->id)  selected @endif value="{{$country->id}}">{{$country->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>  
                      </div>

                <div class="form-group col-md-6">
                                    <label>اختر المدينة</label>
                                    <div class="form-group col-md-12">
                                        <select name="city_id" id="city">
                                            <option value="">اختر المدينة</option>
                                            @foreach ($cities as $city)
                    
                                        <option  @if($editem->city_id == $city->id)   selected @endif value="{{$city->id}}">{{$city->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>  
                      </div>
                    <div class="form-group col-md-6">
                      <label>رقم الواتس</label>
                    <input type="text" name="whatsapp" value="{{$editem->whatsapp}}" class="form-control" placeholder = 'رقم الواتس'>
                      @if ($errors->has('whatsapp'))
                          <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('whatsapp') }}</div>
                      @endif  
                  </div>

                  <div class="form-group col-md-6">
                      <label>رقم الهاتف</label>
                  <input type="text" name="phone" value="{{$editem->phone}}" class="form-control" placeholder = 'رقم الهاتف'>
                      @if ($errors->has('phone'))
                          <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('phone') }}</div>
                      @endif  
                  </div>


                  
                  <div class="form-group col-md-6">
                    <label>السعر [ريال]</label>
                    <input type="number" name="price" class="form-control" placeholder = 'ادخل السعر' value="{{$editem->price}}" required>
                    @if ($errors->has('price'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('price') }}</div>
                    @endif  
                  </div>

                 


                   <div class="form-group col-md-12">
                    <label>صور اكثر عن الاعلان [يمكنك رفع اكثر من صورة]</label>
                    <input type="file" name="items[]" multiple>
                    @if ($errors->has('items'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('items') }}</div>
                    @endif  
                  </div>

                  <div class="form-group col-md-12">
                      <label>صور الاعلان</label>
                      <br>
                      @foreach($adimages as $image)
                      <div style="padding: 2%;" class="col-md-3">
                          <img class="img-thumbnail" style="width:100%; height:10%;" src="{{asset('users/images/'.$image->image)}}" alt="">
                      </div>
                      @endforeach
                  </div>

                  <div class="col-md-12">
                      <div class="box box-info">
                          <div class="box-header">
                          <h3 class="box-title" > تفاصيل المنتج</h3>
                          </div>
                          <div class="box-body pad">
                              <textarea id="editor1" name="ardesc" rows="10" cols="167" required>{!! $editem->details !!}</textarea>
                              @if ($errors->has('ardesc'))
                                  <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('ardesc') }}</div>
                              @endif
                          </div>
                      </div>
                  </div>
               
                <div class="box-footer">
                  <button style="width: 20%;margin-right: 40%;" type="submit" id="submit1" class="btn btn-primary">تعديل</button>
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
