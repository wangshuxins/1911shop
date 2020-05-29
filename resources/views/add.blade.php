<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>微商城后台-商品品牌</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">微商城</a>
		</div>
		<div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="{{url('/brand')}}">商品品牌</a></li>
				<li><a href="{{url('/cate')}}">商品分类</a></li>
				<li><a href="{{url('/goods')}}">商品管理</a></li>
				<li><a href="{{url('/admin')}}">管理员管理</a></li>
			</ul>
		</div>
		</div>
	</nav>
<center>
	<h2>商品品牌 
		<span style="float:right"><a class="btn btn-default" href="{{'/brand'}}">展示</a></span>
	</h2>
</center><hr/>
<!-- @if ($errors->any()) 
	<div class="alert alert-danger"> 
		<ul>@foreach ($errors->all() as $error) 
			<li>{{ $error }}</li> 
			@endforeach
		</ul> 
	</div> 
@endif -->
<form class="form-horizontal" role="form" method="post" action="{{url('/doadd')}}" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章名称</label>
		<div class="col-sm-10">
			<input type="text" name="brand_name" class="form-control" id="firstname" 
				   placeholder="请输入文章名称">
			<b style="color:red">{{$errors->first('brand_name')}}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio" name="show3" value="1" checked>是
			<input type="radio" name="show3" value="2">否
			
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-10">
			<input type="radio" name="show1" value="1" checked>普通
			<input type="radio" name="show1" value="2">顶置
			
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-10">
			<input type="text" name="show2" class="form-control" id="lastname" 
				   placeholder="请输入文章作者">
			<b style="color:red">{{$errors->first('show2')}}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章网址</label>
		<div class="col-sm-10">
			<input type="text" name="brand_url" class="form-control" id="lastname" 
				   placeholder="请输入文章网址">
			<b style="color:red">{{$errors->first('brand_url')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-10">
			<input type="file" name="brand_logo" class="form-control" id="lastname" >
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章描述</label>
		<div class="col-sm-10">
			<textarea type="text" name="brand_desc" class="form-control" id="lastname"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">提交</button>
		</div>
	</div>
</form>

</body>
<html>

