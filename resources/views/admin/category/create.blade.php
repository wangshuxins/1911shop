<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 微商城后台 - 分类</title>
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
<h1 style="color:red">分类管理<span style="float:right"><a class="btn btn-default" href="{{url('/category')}}">列表</a></span></h1>
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
<form class="form-horizontal" role="form" method="post" action="{{url('/category/store')}}" >
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="cate_name" id="firstname" 
				   placeholder="请输入分类名称">
		     <b style="color:red">{{$errors->first('cate_name')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">儿级分类</label>
		<div class="col-sm-10">
			        <select class="form-control" name="pid" id="lastname">
						<option value="">请选择</option>
						@foreach($cate as $v)
                        <option value="{{$v->cate_id}}">{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
						@endforeach
			        </select>
				    <b style='color:red'>{{$errors->first('pid')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  name="cate_show" id="lastname" value="1" checked>是
			<input type="radio"  name="cate_show" id="lastname" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否导航显示</label>
		<div class="col-sm-10">
			<input type="radio"   name="cate_nav_show" id="lastname" value="1">是
			<input type="radio"   name="cate_nav_show" id="lastname" value="2" checked>否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-10">
			<textarea name="cate_desc" rows="" cols=""></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default">添加</button>
		</div>
	</div>
</form>
<script>

$('input[name="cate_name"]').blur(function(){

   var cate_name = $(this).val();
    
     $(this).next().empty();

  if(!(/^[\u4e00-\u9fa5}\w]{2,60}$/.test(cate_name))){
  
     $(this).next().text('分类名称格式不正确');
	 return;
   }

    $.ajaxSetup({headers:{
   
   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
   
   }
   })
   $.post('/category/checknameb',{cate_name:cate_name},function(res){
   
  if(res>0){
  
  $('input[name="cate_name"]').next().text('分类名称已存在!');
 
  
     }
   });
 });



$('select[name="pid"]').blur(function(){



 var pid = $('select[name="pid"]').val();

 
 $(this).next().empty();
  
 
 if(pid==''){
 
  $('select[name="pid"]').next().text('分类id不能为空!');

  return;
 
 }

});

 $("button").click(function(){

	 
   var cate_name = $('input[name="cate_name"]').val();

  if(!(/^[\u4e00-\u9fa5}\w]{2,60}$/.test(cate_name))){
  
    $('input[name="cate_name"]').next().text('分类名称格式不正确');
	 return;
   }
   var flag = true;
   $.ajaxSetup({headers:{
   
   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
   }
   })
   $.ajax({

	type:'post',

	data:{cate_name:cate_name},

    url:'/category/checknameb',

	async:false,
	
	success:function(msg){
	
	if(msg>0){
	
	$('input[name="cate_name"]').next().text('分类名称已存在s!');
	flag = false;
	}
	}
   });
  if(!flag) return;

   var pid = $('select[name="pid"]').val();

 
 $('select[name="pid"]').next().empty();
  
 
 if(pid==''){
 
  $('select[name="pid"]').next().text('分类id不能为空!');

  return;
 
 }


  $('form').submit();
});


</script>
</body>
</html>