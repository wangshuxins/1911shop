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
    <a class="navbar-admin" href="#">微商城</a>
</div>
<div>
    <ul class="nav navbar-nav">
	<li><a href="{{url('/admin')}}">商品管理员</a></li>
	<li><a href="{{url('/category')}}">商品分类</a></li>
	<li><a href="{{url('/goods')}}">商品管理</a></li>
	<li><a href="{{url('/admin')}}">管理员管理</a></li>
	</ul>
</div>
</div>
</nav>
<center>
<h1 style="color:red">管理员修改<span style="float:right"><a class="btn btn-default" href="{{url('/admin')}}">列表</a></span></h1>
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
<form class="form-horizontal" role="form" method="post" action="{{url('/admin/update/'.$admin->admin_id)}}" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="admin_name" id="firstname" 
				   placeholder="请输入管理员名称" value="{{$admin->admin_name}}" admin_id="{{$admin->admin_id}}">
		     <b style="color:red">{{$errors->first('admin_name')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员电话</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="admin_tel" id="lastname" 
				   placeholder="请输入管理员电话" value="{{$admin->admin_tel}}">
				    <b style='color:red'>{{$errors->first('admin_tel')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员邮箱</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="admin_email" id="lastname"
			        placeholder="请输入管理员邮箱"  value="{{$admin->admin_email}}">
					<b style='color:red'>{{$errors->first('admin_email')}}</b> 
		</div>
	</div>
	
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">请输入新密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" style="width:900px" name="admin_pwd" id="lastname"
			        placeholder="请输入新密码"  >
					 <b style='color:red'>{{$errors->first('admin_pwd')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">确认修改密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" style="width:900px" name="admin_pwds" id="lastname"
			       placeholder="请再次确认新密码" >
				    <b style='color:red'>{{$errors->first('admin_pwds')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员头像</label>
		<div class="col-sm-3">
			<input type="file" class="form-control" name="admin_img" id="lastname">
			
		</div>
		@if($admin->admin_img)
			<img width="50" src="{{env('UPLOADS_URL')}}{{$admin->admin_img}}">
		   @endif
		
	</div>
	 
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default">修改</button>
		</div>
	</div>
</form>
<script>

$('input[name="admin_name"]').blur(function(){

   var admin_name = $(this).val();

   var admin_id = $(this).attr('admin_id');

  // alert(admin_id);
    
     $(this).next().empty();

  if(!(/^[\u4e00-\u9fa5}\w]{2,60}$/.test(admin_name))){
  
     $(this).next().text('管理员名称格式不正确');
	 return;
   }

    $.ajaxSetup({headers:{
   
   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
   
   }
   })
   $.post('/admin/updateNamed',{admin_id:admin_id,admin_name:admin_name},function(res){
   
  if(res>0){
  
  $('input[name="admin_name"]').next().text('管理员名称已存在!');
 
  
     }
   });
 });


 

$('input[name="admin_tel"]').blur(function(){



 var admin_tel = $('input[name="admin_tel"]').val();

 
 $(this).next().empty();
  
 
 if(admin_tel==''){
 
  $('input[name="admin_tel"]').next().text('管理员手机号不能为空!');

  return;
 
 }else if(!(/^1[0-9]{10}$/.test(admin_tel))){
 
 $('input[name="admin_tel"]').next().text('管理员手机号格式不正确!');

  return;

 }
});


$('input[name="admin_email"]').blur(function(){



 var admin_email = $('input[name="admin_email"]').val();

 
 $(this).next().empty();
  
 
 if(admin_email==''){
 
  $('input[name="admin_email"]').next().text('管理员邮箱不能为空!');

  return;
 
 }else if(!(/^[0-9a-zA-Z]+@\w+(\.)com$/.test(admin_email))){
 
 $('input[name="admin_email"]').next().text('管理员邮箱格式不正确!');

  return;

 }
});


$('input[name="admin_pwd"]').blur(function(){



 var admin_pwd = $('input[name="admin_pwd"]').val();

 
 $(this).next().empty();
  
 
 if(admin_pwd==''){
 
  $('input[name="admin_pwd"]').next().text('管理员密码不能为空!');

  return;
 
 }else if(!(/^[0-9a-zA-Z]{6,12}$/.test(admin_pwd))){
 
 $('input[name="admin_pwd"]').next().text('管理员密码格式不正确!');

  return;

 }
});


$('input[name="admin_pwds"]').blur(function(){

$(this).next().empty();

 var admin_pwds = $('input[name="admin_pwds"]').val();

  var admin_pwd = $('input[name="admin_pwd"]').val();

 
 if(admin_pwds==''){
 
  $('input[name="admin_pwds"]').next().text('管理员密码不能为空!');

  return;
 
 }else if(admin_pwds!=admin_pwd){
 
 $('input[name="admin_pwds"]').next().text('两次密码不一致!');

  return;


 }
});






 $("button").click(function(){

	 
   var admin_name = $('input[name="admin_name"]').val();

    var admin_id =  $('input[name="admin_name"]').attr('admin_id');

  if(!(/^[\u4e00-\u9fa5}\w]{2,60}$/.test(admin_name))){
  
    $('input[name="admin_name"]').next().text('管理员名称格式不正确');
	 return;
   }
   var flag = true;
   $.ajaxSetup({headers:{
   
   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
   }
   })
   $.ajax({

	type:'post',

	data:{admin_id:admin_id,admin_name:admin_name},

    url:'/admin/updateNamed',

	async:false,
	
	success:function(msg){
	
	if(msg>0){
	
	$('input[name="admin_name"]').next().text('管理员名称已存在s!');
	flag = false;
	}
	}
   });
  if(!flag) return;

 var admin_tel = $('input[name="admin_tel"]').val();

 
$('input[name="admin_tel"]').next().empty();
  
 
 if(admin_tel==''){
 
  $('input[name="admin_tel"]').next().text('管理员手机号不能为空!');

  return;
 
 }else if(!(/^1[0-9]{10}$/.test(admin_tel))){
 
 $('input[name="admin_tel"]').next().text('管理员手机号格式不正确!');

  return;

 }


var admin_email = $('input[name="admin_email"]').val();

 
 $('input[name="admin_email"]').next().empty();
  
 
 if(admin_email==''){
 
  $('input[name="admin_email"]').next().text('管理员邮箱不能为空!');

  return;
 
 }else if(!(/^[0-9a-zA-Z]+@\w+(\.)com$/.test(admin_email))){
 
 $('input[name="admin_email"]').next().text('管理员邮箱格式不正确!');

  return;

 }

  var admin_pwd = $('input[name="admin_pwd"]').val();

 
 $('input[name="admin_pwd"]').next().empty();
  
 
 if(admin_pwd==''){
 
  $('input[name="admin_pwd"]').next().text('管理员密码不能为空!');

  return;
 
 }else if(!(/^[0-9a-zA-Z]{6,12}$/.test(admin_pwd))){
 
 $('input[name="admin_pwd"]').next().text('管理员密码格式不正确!');

  return;

 }

 $('input[name="admin_pwds"]').next().empty();

 var admin_pwds = $('input[name="admin_pwds"]').val();

  var admin_pwd = $('input[name="admin_pwd"]').val();

 
 if(admin_pwds==''){
 
  $('input[name="admin_pwds"]').next().text('管理员密码不能为空!');

  return;
 
 }else if(admin_pwds!=admin_pwd){
 
 $('input[name="admin_pwds"]').next().text('两次密码不一致!');

  return;


 }

  $('form').submit();
});


</script>
</body>
</html>