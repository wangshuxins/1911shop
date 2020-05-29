<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name='csrf-token' content="{{csrf_token()}}">
</head>
<body>
<nav class="navbar navbar-dafault" role="navigation">
<div class="container-fluid">
<div class="navbar-header">
    <a class="navbar-brand" href="#">微商城</a>
</div>
<div>
    <ul class="nav navbar-nav">
	<li><a href="{{url('/brand')}}">商品品牌</a></li>
	<li><a href="{{url('/category')}}">商品分类</a></li>
	<li><a href="{{url('/goods')}}">商品管理</a></li>
	<li><a href="{{url('/admin')}}">管理员管理</a></li>
	</ul>
</div>
</div>
</nav>
<center>
<h1 style="color:red">商品品牌<span style="float:right"><a class="btn btn-default" href="{{url('/brand')}}">列表</a></span></h1>
</center>
<hr/>
<!-- @if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul></div>
@endif -->
<form class="form-horizontal" role="form" method="post" action="{{url('/brand/store')}}" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="brand_name" id="firstname" 
				   placeholder="请输入品牌名称">
		     <b style="color:red">{{$errors->first('brand_name')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="brand_url" id="lastname" 
				   placeholder="请输入品牌网址">
				    <b style='color:red'>{{$errors->first('brand_url')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" style="width:900px" name="brand_logo" id="lastname">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" style="width:600px;height:150px" name="brand_desc" id="lastname"></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10" >
			<button type="button" class="btn btn-default">添加</button>
		</div>
	</div>
</form>
</body>
</html>
<script>

$('input[name="brand_name"]').blur(function(){

   var brand_name = $(this).val();
    
     $(this).next().empty();

  if(!(/^[\u4e00-\u9fa5}\w]{2,60}$/.test(brand_name))){
  
     $(this).next().text('品牌名称格式不正确');
	 return;
   }

    $.ajaxSetup({headers:{
   
   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
   
   }
   })
   $.post('/brand/checknamea',{brand_name:brand_name},function(res){
   
  if(res>0){
  
  $('input[name="brand_name"]').next().text('品牌名称已存在!');
 
  
     }
   });
 });

 $('input[name="brand_url"]').blur(function(){



 var brand_url = $('input[name="brand_url"]').val();

 
 $(this).next().empty();
  
 
 if(brand_url==''){
 
  $('input[name="brand_url"]').next().text('品牌邮箱不能为空!');

  return;
 
 }else if(!(/^[0-9a-zA-Z]+@\w+(\.)com$/.test(brand_url))){
 
 $('input[name="brand_url"]').next().text('品牌邮箱格式不正确!');

  return;

 }
});

 $("button").click(function(){

	 
   var brand_name = $('input[name="brand_name"]').val();

  if(!(/^[\u4e00-\u9fa5}\w]{2,60}$/.test(brand_name))){
  
    $('input[name="brand_name"]').next().text('品牌名称格式不正确');
	 return;
   }
   var flag = true;
   $.ajaxSetup({headers:{
   
   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
   }
   })
   $.ajax({

	type:'post',

	data:{brand_name:brand_name},

    url:'/brand/checknamea',

	async:false,
	
	success:function(msg){
	
	if(msg>0){
	
	$('input[name="brand_name"]').next().text('品牌名称已存在s!');
	flag = false;
	}
	}
   });
  if(!flag) return;

  var brand_url = $('input[name="brand_url"]').val();

 
 $('input[name="brand_url"]').next().empty();
  
 
 if(brand_url==''){
 
  $('input[name="brand_url"]').next().text('品牌邮箱不能为空s!');

  return;
 
 }else if(!(/^[0-9a-zA-Z]+@\w+(\.)com$/.test(brand_url))){
 
 $('input[name="brand_url"]').next().text('品牌邮箱格式不正确s!');

  return;

 }
  $('form').submit();
});


</script>