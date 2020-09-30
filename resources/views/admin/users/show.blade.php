@extends('admin/include/master')
@section('title') لوحة التحكم | مشاهدة بيانات العضو @endsection
@section('content')  
<section class="content">
    <div class="row">
    
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li style="margin-right: 0px; width:25%" class="active "><a href="#activity" data-toggle="tab"> بيانات العضو الشخصية </a></li>
                    <li style="margin-right: 0px; width:25%"><a href="#activity1" data-toggle="tab">منتجاتي</a></li>
                    <li style="margin-right: 0px; width:25%;"><a href="#activity2" data-toggle="tab">المفضلة</a></li>
                    <li style="margin-right: 0px; width:25%;"><a href="#activity3" data-toggle="tab">تعليقاتي</a></li>
                </ul>
                <div class="tab-content">

                    <div class="active tab-pane" id="activity">
                                    <div class="box-body">
                                        <div style="margin-top: 7%;" class="col-md-6">
                                            
                                            <div class="form-group col-md-12">
                                                <label>الاسم </label>
                                                <input type="text" class="form-control" value="{{$showuser->name}}" readonly> 
                                            </div>
                                            

                                            <div class="form-group col-md-12">
                                                <label>رقم الجوال</label>
                                                <input type="text" class="form-control" value="{{$showuser->phone}}" readonly> 
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>الدولة</label>
                                                <input type="text" class="form-control" value="{{$country->name}}" readonly> 
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>المدينة</label>
                                                <input type="text" class="form-control" value="{{$city->name}}" readonly> 
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                        
                                        <h3 class="box-title" style="float:left;"> {{$showuser->name}}</h3>
                                        
                                            <h4 style="float:right;margin-top: 5%;">
                                                @if($showuser->suspensed == 0)
                                                غير معطل<span> <i class="fa fa-unlock text-success"></i> </span>
                                                @else 
                                                معطل<span> <i class="fa fa-lock text-danger"></i> </span>
                                                @endif 
                                            </h4>
                                            
                                            <div class="col-md-12">
                                                
                                                <img class="img-circle" style="width:100%; height:50%;" src="{{asset('users/images/default2.png')}}" alt="{{$showuser->name}}">
                                               
                                            </div>
                                        </div>
                                    </div>  
                    </div>
            
                    <div class="tab-pane" id="activity1">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">منتجاتي</h3>
                            </div>
            
                            <div class="table-responsive box-body">
                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;"> اسم المنتج</th>
                                            
                                            <th style="text-align:center;">مشاهدة</th>
                                            <th style="text-align:center;"> تعطيل </th>
                                            <th style="text-align:center;"> تعديل </th>
                                            <th style="text-align:center;"> حذف</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items  as $item)
                                    

                                        <tr>
                                            <td>{{$item->artitle}} </td>
                                        
                                            <td>
                                                <a href='{{asset("adminpanel/items/".$item->id)}}' class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </td>
                                            <td>
                                            {{ Form::open(array('method' => 'patch',"onclick"=>"return confirm('هل انت متاكد ؟!')",'files' => true,'url' =>'adminpanel/items/'.$item->id )) }}
                                                <input type="hidden" name="suspensed" >
                                                <button type="submit" class="btn btn-default">
                                                @if($item->suspensed == 1) 
                                                <i style="color:crimson" class="fa fa-lock" aria-hidden="true"></i> 
                                                @else 
                                                <i style="color:#1FAB89" class="fa fa-unlock" aria-hidden="true"></i> 
                                                @endif
                                                </button>
                                            {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <a href='{{asset("adminpanel/items/".$item->id."/edit")}}' class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            </td>

                                            <td>
                                                {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد ؟!')",'files' => true,'url' => array('adminpanel/items/'.$item->id))) }}
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            
                            </div>   

                        </div>
                    </div>

                    <div class="tab-pane" id="activity2">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">المفضلة</h3>
                            </div>
            
                            <div class="table-responsive box-body">
                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;"> اسم المنتج</th>
                                            
                                            <th style="text-align:center;">مشاهدة</th>
                                            <th style="text-align:center;"> تعطيل </th>
                                            <th style="text-align:center;"> تعديل </th>
                                            <th style="text-align:center;"> حذف</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($myfavourites  as $favourite)
                                    <?php $item = DB::table('items')->where('id',$favourite->item_id)->first(); 
                                    $user = DB::table('members')->where('id',$item->user_id)->first(); 
                                    ?>

                                        <tr>
                                            <td>{{$item->artitle}} </td>
                                        
                                            <td>
                                                <a href='{{asset("adminpanel/items/".$item->id)}}' class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </td>
                                            <td>
                                            {{ Form::open(array('method' => 'patch',"onclick"=>"return confirm('هل انت متاكد ؟!')",'files' => true,'url' =>'adminpanel/items/'.$item->id )) }}
                                                <input type="hidden" name="suspensed" >
                                                <button type="submit" class="btn btn-default">
                                                @if($item->suspensed == 1) 
                                                <i style="color:crimson" class="fa fa-lock" aria-hidden="true"></i> 
                                                @else 
                                                <i style="color:#1FAB89" class="fa fa-unlock" aria-hidden="true"></i> 
                                                @endif
                                                </button>
                                            {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <a href='{{asset("adminpanel/items/".$item->id."/edit")}}' class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            </td>

                                            <td>
                                                {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد ؟!')",'files' => true,'url' => array('adminpanel/items/'.$item->id))) }}
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            
                            </div>   

                        </div>
                    </div>
                    
                    <div class="tab-pane" id="activity3">
                        <section class="content-header">
      <h1>
         التعليقات
      </h1>
    </section>

    <section style="direction: ltr;" class="content">
      <div class="row">
        <div class="col-md-12">
          <ul class="timeline">
        @if(count($comments) >0)

                @foreach($comments as $comm) 
                <?php $item = DB::table('items')->where('id',$comm->item_id)->first(); ?>
                        <li>
                            <i class="fa fa-comments bg-yellow"></i>
                            <div style="direction: rtl;margin-bottom: 1%;" class="timeline-item">
                                <span style="float:left;" class="time"><i class="fa fa-clock-o"></i>{{ $comm->created_at }}</span>
                                <h3 style="margin-left: 75%;" class="timeline-header">علق ع  منتج  <a href="{{asset('adminpanel/items/'.$item->id)}}">  {{$item->artitle}}</a> </h3>
                                <div style="float: right;" class="timeline-body">
                                     {{$comm->content}}
                                </div>
                                <br>
                                <div class="timeline-footer">
                                {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد ؟!')",'files' => true,'url' => array('adminpanel/items/'.$comm->id))) }}
                                <input type="hidden" name="delcomment">
                                <button style="width: 10%;" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> حذف </button>
                                {!! Form::close() !!}
                                </div>
                            </div>
                        </li>
                @endforeach
           
        @else 
            <div style="direction: rtl;margin-bottom: 1%;" class="timeline-item">
                <h3 style="margin-left: 75%;" class="timeline-header"></h3>
                <div style="float: right;" class="timeline-body">
                لا يوجد تعليقات  لهذا المستخدم
                </div> 
            </div>
        @endif          
          </ul>
        </div>
      </div>
    </section>
                    </div>
            </div>
        </div>
    </div>
</section> 

@endsection