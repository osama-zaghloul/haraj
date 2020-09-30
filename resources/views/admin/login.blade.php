<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>لوحة التحكم | تسجيل الدخول</title>
  <!-- Shortcut Icon -->
  <link rel="shortcut icon" href="{{asset('users/images/logo_bar.png')}}" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('admin/plugins/iCheck/square/blue.css')}}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div style="height:100vh" class="login-box">
  <div class="login-logo">
  <img style="width: 100%;height: 30%;" src="{{asset('users/images/'.$logo)}}" alt="Logo"><br>
    <a href="{{asset('/adminpanel')}}"><b>لوحة التحكم |</b> تسجيل الدخول </a>
  </div>
 
  <div style="height:30%;" class="login-box-body">
  @if(session()->has('loginfailed') )
    <div style="color: crimson;font-size: 16px;" class="error">{{ session('loginfailed')}}</div>
    <?php session()->forget('loginfailed'); ?>
  @endif   
  
    {!! Form::open(['url' => 'adminpanel/','method' => 'post']) !!}
      <div class="form-group has-feedback">
        <input dir="rtl" type="text" name="username" class="form-control" placeholder="اسم المستخدم">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input dir="rtl" type="password" name="pass" class="form-control" placeholder="كلمة المرور">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
 
        <div class=" col-xs-offset-4 col-md-5">
          <button type="submit" class="btn btn-primary btn-block btn-flat">تسجيل الدخول</button>
        </div>
        
      </div>
      {!! Form::close() !!}
  </div>

<footer style="text-align: center;width: 100%;" class="main-footer">
  <strong> تصميم وبرمجة <a style="color:#222; font-size:15px;" href="https://eltamiuz.com/" target="_blank"> التميز العربى لتصميم وبرمجة المواقع </a>
</footer>

</div>
<script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/plugins/iCheck/icheck.min.js')}}"></script>

</body>
</html>
