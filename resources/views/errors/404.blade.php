<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Page Not Found 404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content=""/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>

    <!--stylesheets-->
    <link rel="stylesheet" type="text/css" href="{{asset('errors/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('errors/css/custom.css')}}">


    <!-- JavaScript plugins (requires jQuery) -->
    <script type="text/javascript" src="{{asset('errors/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('errors/js/tooltip.js')}}"></script>
    <script type="text/javascript" src="{{asset('errors/js/rainyday.js')}}"></script>
    <script type="text/javascript" src="{{asset('errors/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('errors/js/custom.js')}}"></script>

</head>
<body onload="demo();">
<!--content-->
<div class="container">
<br>
<br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="content">
        <h2>4<span>O</span>4</h2>
        <h1>NOT FOUND</h1>
        <p>Sorry, but the page that you requested doesn't exist.</p>
        <a href="{{asset('/')}}" class="button-white" title="">Continue to Our Home Page</a>
    </div>

</div>

<!--canvas animation-->
<img id="background" src="{{asset('errors/images/app-header-bg.jpg')}}" alt=""/>
<div id="cholder">
    <canvas id="canvas"></canvas>
</div>


<script type="text/javascript" src="{{asset('errors/js/signinDialog.js')}}"></script>
<script>
            setTimeout(function () {
                window.location.href= '{{asset('/')}}';

            },5000);
        </script>
</body>
</html>