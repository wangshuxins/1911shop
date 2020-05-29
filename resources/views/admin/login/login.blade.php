<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 微商城后台 - 商品</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<center>
<h1 style="color:red">登陆&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</h1>
</center>
<hr/>

<form class="form-horizontal" role="form" method="post" action="{{url('/login/dologin')}}" >
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">用户名</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="admin_name" id="firstname" 
				   placeholder="请输入用户名">
		      <b style="color:red">{{$errors->first('admin_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" style="width:900px" name="admin_pwd" id="firstname" 
				   placeholder="请输入密码">
		    <b style="color:red">{{$errors->first('admin_pwd')}}</b>
		</div>
	</div>
	<center>
	<div class="form-group">
		
		<div class="col-sm-4 col-sm-5">
		<div class="checkbox">
		<center>
		<label>
			&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type="checkbox" name="isremember">七天免登录
		</label>
		</center>
		</div>
		</div>
	</div>
	</center>
	<center>
	 <b style="color:red">{{session('msg')}}&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</b> 
	<div class="form-group" >
           
		<div class="col-sm-offset-1 col-sm-9" >
		   
			<button type="submit" class="btn btn-default">登陆</button>
		</div>
	</div>
	</center>
</form>

</body>
</html>