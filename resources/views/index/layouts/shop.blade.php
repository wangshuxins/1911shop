<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>微商城-@yield('title')</title>
	<meta name='csrf-token' content="{{csrf_token()}}">
    <link rel="shortcut icon" href="/static/index/images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="/static/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/index/css/style.css" rel="stylesheet">
    <link href="/static/index/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond./static/index/js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="/static/index/js/jquery.min.js"></script>
  </head>
  <body>
    <div class="maincont">
    @yield('content')
     
     
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/index/js/style.js"></script>

	@php $name = Route::currentRouteName();@endphp
	@if($name=='shop.index' || $name =='shop.goods')
	
    <!--焦点轮换-->
    <script src="/static/index/js/jquery.excoloSlider.js"></script>

    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
	@endif
	@if($name == 'shop.goods'||$name == 'shop.car')
	<script src="/static/index/js/jquery.spinner.js"></script>
	<script>
	$('.spinnerExample').spinner({});
	
	</script>
	@endif
	
	
  </body>
</html>