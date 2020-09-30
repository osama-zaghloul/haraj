@extends('admin.include.master')
@section('title') لوحة التحكم @endsection
@section('content')

<section class="content">
<h2> لوحة التحكم | احصائيات </h2> 
<?php 
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
?>
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$allmembers}}</h3>
              <p>الاعضاء</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{asset('adminpanel/users')}}" class="small-box-footer">المزيد<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$allcategories}}</h3>
              <p>الاقسام</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{asset('adminpanel/maincategories')}}" class="small-box-footer">المزيد<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

    
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$allitems}}</h3>
              <p>المنتجات</p>
            </div>
            <div class="icon">
              <i class="fa fa-tags"></i>
            </div>
            <a href="{{asset('adminpanel/items')}}" class="small-box-footer"> المزيد <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$bills}}</h3>
              <p> الفواتير</p>
            </div>
            <div class="icon">
              <i class="fa fa-tags"></i>
            </div>
            <a href="{{asset('adminpanel/bills')}}" class="small-box-footer"> المزيد <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$allreports}}</h3>
              <p> البلاغات</p>
            </div>
            <div class="icon">
              <i class="fa fa-tags"></i>
            </div>
            <a href="{{asset('adminpanel/reports')}}" class="small-box-footer"> المزيد <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$allmessages}}</h3>
              <p>رسائل التواصل معنا</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{asset('adminpanel/contactus')}}" class="small-box-footer">المزيد<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$alltransfers}}</h3>
              <p>التحويلات البنكية</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{asset('adminpanel/transfers')}}" class="small-box-footer">المزيد<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$allcities}}</h3>
              <p> المدن</p>
            </div>
            <div class="icon">
              <i class="fa fa-tags"></i>
            </div>
            <a href="{{asset('adminpanel/cities')}}" class="small-box-footer"> المزيد <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      
</section>
@endsection 