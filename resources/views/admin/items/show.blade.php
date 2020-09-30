@extends('admin/include/master')
@section('title') لوحة التحكم | مشاهدة تفاصيل المنتج @endsection
@section('content')
<?php use Carbon\Carbon; ?>
        <div class="box-body">
            <div style="margin-top: 7%;" class="col-md-6">
                
                

                <div class="form-group col-md-12">
                    <label>كود المنتج</label>
                    <input type="text" class="form-control" value="{{$showitem->id}}" readonly> 
                </div>
                
                <div class="form-group col-md-12">
                    <label>اسم المنتج </label>
                    <input type="text" class="form-control" value="{{$showitem->artitle}}" readonly> 
                </div>
                 <div class="form-group col-md-12">
                    <label>اسم القسم </label>
                    <input type="text" class="form-control" value="{{$catname}}" readonly> 
                </div>


                <div class="form-group col-md-12">
                    <label>السعر [ريال]</label>
                    <input type="text" class="form-control" value="{{$showitem->price}}" readonly> 
                </div>

                 <a  href="{{asset("adminpanel/users/".$user->id)}}" >
                <div class="form-group col-md-12">
                    <label>صاحب المنتج </label>
               
                    <input type="text" class="form-control" value="{{$user->name}}" readonly> 
                    
                </div>
                </a>
                <div class="form-group col-md-12">
                    <label>الدولة</label>
                    <input type="text" class="form-control" value="{{$country->name}}" readonly> 
                </div>
                <div class="form-group col-md-12">
                    <label>المدينة</label>
                    <input type="text" class="form-control" value="{{$city->name}}" readonly> 
                </div>
                <div class="form-group col-md-12">
                    <label>رقم الهاتف</label>
                    <input type="text" class="form-control" value="{{$showitem->phone}}" readonly> 
                </div>
                <div class="form-group col-md-12">
                    <label>الواتس آب</label>
                    <input type="text" class="form-control" value="{{$showitem->whatsapp}}" readonly> 
                </div>

                
                

            </div>

            <div class="col-md-6">
            <h6 class="box-title" style="float:left;"> تاريخ الاعلان : {{ $showitem->created_at }}</h6><br>
              
                <h4 style="float:right;margin-top: 5%;">
                     @if($showitem->suspensed == 0)
                      غير معطل<span> <i class="fa fa-unlock text-success"></i> </span>
                    @else 
                       معطل<span> <i class="fa fa-lock text-danger"></i> </span>
                    @endif 
                </h4>    
                
                
                <div class="col-md-12">
                      <img class="img-thumbnail" style="width:100%; height:30%;" src="{{asset('users/images/'.$adimg->image)}}" alt="">
                </div>
                
                <div class="form-group col-md-12">
                    <label>صور المنتج</label>
                    <br>
                    @foreach($adimages as $image)
                    <div style="padding: 2%;" class="col-md-4">
                        {{ Form::open(array('method' => 'DELETE','id' => 'del'.$image->id,"onclick"=>"return confirm('هل انت متأكد ؟!')",'files' => true,'url' => array('adminpanel/items/'.$image->id))) }}
                                <input type="hidden" name="del-single-image">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        {!! Form::close() !!}
                        <img class="img-thumbnail" style="width:100%; height:10%;" src="{{asset('users/images/'.$image->image)}}" alt="">
                    </div>
                    @endforeach
                </div>

                </hr>
                @if($showitem->video)
                <div class="form-group col-md-12">
                    <label>فيديو المنتج</label>
                    
                      <video controls class="img-thumbnail" style="width:100%; height:30%;" src="{{asset('users/videos/'.$showitem->video)}}" alt=""></video>
                </div>
                @endif
                <hr>
                <div class="form-group col-md-12">
                    <label>تفاصيل المنتج</label>                                    
                    <textarea rows='10' type="text" class="form-control" readonly>{!! $showitem->details !!}</textarea>
                </div>
                
            </div>
        </div>    
@endsection