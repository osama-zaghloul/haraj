<html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>
  <title>@yield('title')</title>  
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{asset('users/images/logo_bar.png')}}" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- jQuery 3 -->
<script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/dist/css/bootstrap-rtl.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/dist/css/style.min.css')}}" />
  <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('admin/dist/js/ajaxapp.js')}}"></script>
  <!-- <link rel="stylesheet" href="{{asset('admin/dist/css/dist/css/rtl.css')}}"> -->
 <style type="text/css">
 body,h3{
     font-family: 'Cairo', sans-serif;
 }
   /**************processing***********************************/
    .sct-link-top_mod1 {

    }
    .sct-link-top_mod1::before {
        position: absolute;
        content: '';
        width: 157px;
        height: 68px;
        background-image: url("{{asset('users/img/add-p.png')}}");
        bottom: 0%;
        left: 50%;
        -webkit-transform: translateX(-50%);
        transform: translateX(-50%);
    }
    .sct-link-top_mod1 .nav-link {
        position: absolute;
        -webkit-transform: translateX(-50%);
        transform: translateX(-50%);
        color: #000;
        font-size: 19px;
        left: 50%;
        top:94%;
        transition: 0.2s;
    }
    /* .sct-link-top_mod1 .nav-link:hover {  
        top: 95%;   
    } */
    .well2 {
        padding-top: 108px;
        padding-bottom: 132px;
    }
    .well1 {
        padding-top: 116px;
        padding-bottom: 68px;
    }
    .bg1 {
        /*background: #42b773;
        background: -webkit-gradient(left top, left bottom, color-stop(0%, #42b773), color-stop(100%, #a9dc56));
        background: linear-gradient(to bottom, #42b773 0%, #a9dc56 100%);*/
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#42b773', endColorstr='#a9dc56', GradientType=0 );
    }
    .sct-link-top_mod1 {
        position: relative;
        z-index: 1;
    }
    .center {
        text-align: center;
    }
    .white {
        color: #fff;
    }
    .circle {
        border-radius: 50%;
        max-width: 65%;
    }
    @media only screen and (max-width:767px){
        .num{
            margin-left: 40%;
        }
        .sct-link-top_mod1 .nav-link {
           top: 96%;
        }
        /* .sct-link-top_mod1 .nav-link:hover {  
        top: 97%;    */
    }
        
    }
 </style>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-open">

 <div class="wrapper">

 <header class="main-header" style="color:#e24800">
    
    <!-- Logo -->
    <a href="{{asset('adminpanel')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img style="width:44%;margin-top: 7px;" src="{{asset('users/images/'.$logo)}}" class="img-circle" alt="Logo"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img style="margin-top: 2px;width:25%;" src="{{asset('users/images/'.$logo)}}" alt="Logo"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
    </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

      
      </li> 
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('users/images/'.auth()->guard('admin')->user()->image)}}" class="user-image" alt="User Image">
              <span class="hidden-xs">
               {{auth()->guard('admin')->user()->username}}
              </span>
            </a>
            <ul style="width: 345%;" class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('users/images/'.auth()->guard('admin')->user()->image)}}" class="img-circle" alt="User Image">
                @if(auth()->guard('admin')->user()->id == 1) 
                <p>  الادمن - {{auth()->guard('admin')->user()->username}} </p>
                @else 
                <p>{{auth()->guard('admin')->user()->username}} - مطور الموقع</p>
                @endif  
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                
                  @if(auth()->guard('admin')->user()->id == 1)
                  <a href='{{asset("adminpanel/provider/". auth()->guard('admin')->user()->id )}}/edit' class="btn btn-default btn-flat">الصفحة الشخصية </a> 
                  <a href="{{asset('adminpanel/provider')}}" class="btn btn-default btn-flat">اضافة مطور</a>
                  @else 
                  <a href='{{asset("adminpanel/provider/". auth()->guard('admin')->user()->id )}}/edit' class="btn btn-default btn-flat">الصفحة الشخصية</a>
                  @endif
                </div>
                <div class="pull-left">
                  {!! Form::open(array('url' => 'adminpanel/1','method'=>'delete')) !!}
                  <button type="submit" class="btn btn-block">تسجيل خروج</button>
                  {!! Form::close() !!}
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('users/images/'.auth()->guard('admin')->user()->image)}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
        @if(auth()->guard('admin')->user()->id == 1)
          <p>{{auth()->guard('admin')->user()->username}}</p>
          <i class="fa fa-circle text-success"></i> الادمن
          @else
          <p>{{auth()->guard('admin')->user()->username}}</p>
          <i class="fa fa-circle text-success"></i> مطور الموقع
        @endif  
        </div>
      </div>
    
    <ul class="sidebar-menu">
    
        @if($mainactive=='users')
          <li class="active treeview"> 
        @else
          <li class="treeview">
        @endif
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>الاعضاء</span><i class="fa fa-angle-left pull-left"></i>
          </a>
          <ul class="treeview-menu">
            <li  @if($subactive=='adduser') class="active" @endif><a href="{{asset('adminpanel/users/create')}}"><i class="fa fa-circle-o"></i>اضافة عضو</a></li>
            <li  @if($subactive=='user') class="active" @endif><a href="{{asset('adminpanel/users')}}"><i class="fa fa-circle-o"></i>كل الاعضاء</a></li>
          </ul>

          @if($mainactive=='categories')
            <li class="active treeview"> 
          @else
            <li class="treeview">
          @endif
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>الاقسام</span><i class="fa fa-angle-left pull-left"></i>
            </a>
            <ul class="treeview-menu">
              <li  @if($subactive=='maincategory') class="active" @endif><a href="{{asset('adminpanel/maincategories')}}"><i class="fa fa-circle-o"></i>أقسام المنتجات </a></li>
              
            </ul>
            
            @if($mainactive=='cities')
            <li class="active treeview"> 
          @else
            <li class="treeview">
          @endif
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>الدول والمدن</span><i class="fa fa-angle-left pull-left"></i>
            </a>
            <ul class="treeview-menu">
               <li  @if($subactive=='country') class="active" @endif><a href="{{asset('adminpanel/countries')}}"><i class="fa fa-circle-o"></i>الدول</a></li>
              <li  @if($subactive=='city') class="active" @endif><a href="{{asset('adminpanel/cities')}}"><i class="fa fa-circle-o"></i>المدن</a></li>
              
            </ul>

        
        @if($mainactive=='items')
          <li class="active treeview"> 
        @else
          <li class="treeview">
        @endif
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>المنتجات</span><i class="fa fa-angle-left pull-left"></i>
          </a>
          <ul class="treeview-menu">
            <li  @if($subactive=='additem') class="active" @endif><a href="{{asset('adminpanel/items/create')}}"><i class="fa fa-circle-o"></i>إضافة منتج</a></li>
            <li  @if($subactive=='item') class="active" @endif><a href="{{asset('adminpanel/items')}}"><i class="fa fa-circle-o"></i>كل المنتجات</a></li>
          </ul>

       
        @if($mainactive=='bills')
          <li class="active treeview"> 
        @else
          <li class="treeview">
        @endif
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>الفواتير</span><i class="fa fa-angle-left pull-left"></i>
          </a>
          <ul class="treeview-menu">
            <li  @if($subactive=='itemorders') class="active" @endif><a href="{{asset('adminpanel/bills')}}"><i class="fa fa-circle-o"></i>كل الفواتير </a></li>
          </ul>

         @if($mainactive=='commissions')
          <li class="active treeview"> 
        @else
          <li class="treeview">
        @endif
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>العمولات  </span><i class="fa fa-angle-left pull-left"></i>
          </a>
          <ul class="treeview-menu">
          <li  @if($subactive=='commission') class="active" @endif><a href="{{asset('adminpanel/commissions')}}"><i class="fa fa-circle-o"></i>كل العمولات </a></li>
          
          </ul>
          
           @if($mainactive=='blacklists')
          <li class="active treeview"> 
        @else
          <li class="treeview">
        @endif
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>القائمة السوداء  </span><i class="fa fa-angle-left pull-left"></i>
          </a>
          <ul class="treeview-menu">
          <li  @if($subactive=='blacklists') class="active" @endif><a href="{{asset('adminpanel/blacklists')}}"><i class="fa fa-circle-o"></i>القائمة السوداء </a></li>
          
          </ul>


           @if($mainactive=='reports')
          <li class="active treeview"> 
        @else
          <li class="treeview">
        @endif
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>البلاغات  </span><i class="fa fa-angle-left pull-left"></i>
          </a>
          <ul class="treeview-menu">
          <li  @if($subactive=='report') class="active" @endif><a href="{{asset('adminpanel/reports')}}"><i class="fa fa-circle-o"></i>بلاغات المنتجات </a></li>
          <li  @if($subactive=='comreport') class="active" @endif><a href="{{asset('adminpanel/comreports')}}"><i class="fa fa-circle-o"></i>بلاغات التعليقات </a></li>

          </ul>


        @if($mainactive=='contactus')
          <li class="active treeview"> 
        @else
          <li class="treeview">
        @endif
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>تواصل معنا </span><i class="fa fa-angle-left pull-left"></i>
          </a>
          <ul class="treeview-menu">
          <li  @if($subactive=='contactus') class="active" @endif><a href="{{asset('adminpanel/contactus')}}"><i class="fa fa-circle-o"></i>كل الرسائل</a></li>
          </ul>
          
        @if($mainactive=='transfers')
          <li class="active treeview"> 
        @else
          <li class="treeview">
        @endif
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>التحويلات البنكية</span><i class="fa fa-angle-left pull-left"></i>
          </a>
          <ul class="treeview-menu">
              <li  @if($subactive=='transfer') class="active" @endif><a href="{{asset('adminpanel/transfers')}}"><i class="fa fa-circle-o"></i>كل التحويلات</a></li>
          </ul>
        
        @if($mainactive=='setting')
          <li class="active treeview"> 
        @else
          <li class="treeview">
        @endif
          <a href="#">
              <i class="fa fa-dashboard"></i> <span> الاعدادات </span><i class="fa fa-angle-left pull-left"></i>
          </a>
          <ul class="treeview-menu">
              <li  @if($subactive=='slider') class="active" @endif><a href="{{asset('adminpanel/sliders')}}"><i class="fa fa-circle-o"></i>اضافة سليدر</a></li>
              <li  @if($subactive=='bannedads') class="active" @endif><a href="{{asset('adminpanel/bannedads')}}"><i class="fa fa-circle-o"></i>قائمة السلع والإعلانات الممنوعة</a></li>
              <li  @if($subactive=='treaty') class="active" @endif><a href="{{asset('adminpanel/treaty')}}"><i class="fa fa-circle-o"></i>معاهدة الإستخدام</a></li>
              <li  @if($subactive=='dissystem') class="active" @endif><a href="{{asset('adminpanel/dissystem')}}"><i class="fa fa-circle-o"></i>نظام الخصم</a></li>
              <li  @if($subactive=='changelogo') class="active" @endif><a href="{{asset('adminpanel/setapp')}}"><i class="fa fa-circle-o"></i>إعدادات التطبيق</a></li>
          </ul>          
    </ul>
  </section>
</aside>

 <div class="content-wrapper" style="min-height: 660.102px;">
    @if(session('success'))
      <div style="color: green;font-size: 18px;padding: 1%;" class="text-center">{{session('success')}}</div>
      {{session()->forget('success')}}
    @endif
     @yield('content') 
  </div>

<footer class="main-footer">
  <strong> تصميم وبرمجة <a style="color:#222; font-size:15px;" href="https://eltamiuz.com/" target="_blank"> التميز العربى لتصميم وبرمجة المواقع </a>
</footer>

</div>


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
<!-- Morris.js charts -->
<script src="{{asset('admin/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('admin/bower_components/morris.js/morris.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('admin/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- CK Editor -->
<script src="{{asset('admin/bower_components/ckeditor/ckeditor.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/app.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>
<script src="{{asset('admin/dist/js/notify.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<script src="{{asset('admin/dist/js/jstree.min.js')}}"></script>
<script src="{{asset('admin/dist/js/jstree.checkbox.js')}}"></script>
<script src="{{asset('admin/dist/js/jstree.wholerow.js')}}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<!-- page script -->

<script>
    $('.numbersOnly').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

    function scorePassword(pass) 
    {
            var score = 0;
            if (!pass)
                return score;

            // award every unique letter until 5 repetitions
            var letters = new Object();
            for (var i=0; i<pass.length; i++) {
                letters[pass[i]] = (letters[pass[i]] || 0) + 1;
                score += 5.0 / letters[pass[i]];
            }

            // bonus points for mixing it up
            var variations = {
                digits: /\d/.test(pass),
                lower: /[a-z]/.test(pass),
                upper: /[A-Z]/.test(pass),
                nonWords: /\W/.test(pass),
            }

            variationCount = 0;
            for (var check in variations) {
                variationCount += (variations[check] == true) ? 1 : 0;
            }
            score += (variationCount - 1) * 10;

            return parseInt(score);
          }

          function checkPassStrength(pass) 
          {
            var score = scorePassword(pass);
            if (score > 80)
                return "strong";
            if (score > 60)
                return "good";
            if (score >= 30)
                return "weak";

            return "";
          }

        $("#adminpass1").on("keypress keyup keydown", function() {
            var pass = $(this).val();
            $("#strength_human2").text(checkPassStrength(pass));
            if(checkPassStrength(pass)=='weak'){
                $('#errorpass').css('background-color','crimson');
                $('#errorpass').css('display','block');
            }
            else if(checkPassStrength(pass)=="good"){
                $('#errorpass').css('background-color','#f18e00');
                $('#errorpass').css('display','block');
            }
            else if(checkPassStrength(pass)=="strong"){
                $('#errorpass').css('background-color','green');
                $('#errorpass').css('display','block');
            }
			else 
			{
				$('#errorpass').css('display','none');
			}
        });

        $("#confirmadminpass1").on("keypress keyup keydown", function() 
        {
            var pass = $(this).val();
            if(pass == $("#adminpass1").val())
            {
              if(checkPassStrength(pass)=="good" || checkPassStrength(pass)=="strong")
                {
                  $('#submit1').prop('disabled',false);
                  $('#errorconfirm').css('display','none');
                  $('#passchecked').css('display','block');
                }
            }
            else
            {
              $('#submit1').prop('disabled',true);
                      $('#errorconfirm').css('display','block').html('The Password Not Math');
              $('#passchecked').css('display','none');
            }
        });

        $("#oldpassword").on("keypress keyup keydown", function() 
            {
                if($(this).val() == '' )
                {
                  $("#adminpass1").prop('disabled',true);
                  $("#confirmadminpass1").prop('disabled',true);
                }
                else 
                {
                  $("#adminpass1").prop('disabled',false);
                  $("#confirmadminpass1").prop('disabled',false);
                  
                }
            });

</script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example3').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : true
    });  
  })

  $('#example4').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false
    }); 
</script>
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        // bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    });

    $(function () {
        // Replace the <textarea id="editor2"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor2')
        // bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    });

        $(function () {
        // Replace the <textarea id="editor2"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor3')
        // bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    });
</script>

<!-- ajax scripts  -->

<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $('#role').change(function() {
        var role = $('#role').val();
        if(role == 1)
        {
          $('#companyinfo').css('display','block');
        }
        else 
        {
          $('#companyinfo').css('display','none');
        }
  });

</script>

<script src="https://github.com/Nickersoft/push.js.git"></script>
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('f311fe3aca325b4c40ad', {
      cluster: 'eu'
    });

    var channel = pusher.subscribe('alert');
    if(channel){
    channel.bind('alertNot', function(data) {
      // Notification.requestPermission();
      new Notification('kkkkkk');
      // new Notification('طلب جديد من '+data.name);

      // alertify.set('notifier','position', 'bottom-left');
      // alertify.success('  : طلب جديد من '+ data.name );
      // alert(data.name);
      // $.notify("طلب جديد من "+data.name, "success");
      // var not = document.querySelector('.badge');
      // not.html +=1;
      
      // alertify.notify('<a href="http://localhost/alamana/adminpanel/orders">طلب جديد من </a>', 'success', 5, function(){  console.log('dismissed'); });
      // console.log('kkkkkkkk');
    });
  }else{
    console.log('kkkkkkkk');
  }
  </script>
</body>
</html>
