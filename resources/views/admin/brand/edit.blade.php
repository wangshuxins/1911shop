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
<center>
<h1 style="color:red">商品品牌修改<span style="float:right"><a class="btn btn-default" href="{{url('/brand/')}}">列表</a></span></h1>
</center>
<hr/>
<form class="form-horizontal" role="form" method="post" action="{{url('/brand/update/'.$brand->brand_id)}}" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="brand_name" id="firstname" 
				  value="{{$brand->brand_name}}" brand_id="{{$brand->brand_id}}" placeholder="请输入品牌名称">
				   <b style="color:red">{{$errors->first('brand_name')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="brand_url" id="lastname" 
				  value="{{$brand->brand_url}}" placeholder="请输入品牌网址">
				  <b style='color:red'>{{$errors->first('brand_url')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
		<div class="col-sm-3">
			<input type="file" class="form-control"  name="brand_logo" id="lastname">
		</div>
		@if($brand->brand_logo)
			<img width="50" src="{{env('UPLOADS_URL')}}{{$brand->brand_logo}}">
		@endif
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" style="width:600px;height:150px" name="brand_desc" id="lastname">{{$brand->brand_desc}}</textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default">编辑</button>
		</div>
	</div>
</form>

</body>
<script>

$('input[name="brand_name"]').blur(function(){

   var brand_name = $(this).val();

   var brand_id = $(this).attr('brand_id');

   //$(this).next().empty();

  if(!(/^[\u4e00-\u9fa5}\w]{2,60}$/.test(brand_name))){
  
     $(this).next().text('品牌名称格式不正确');
	 return;
   }

    $.ajaxSetup({headers:{
   
   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
   
   }
   })
   $.post('/brand/updateNamea',{brand_id:brand_id,brand_name:brand_name},function(res){
   
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

	 var brand_id = $(this).attr('brand_id');

   var brand_name = $('input[name="brand_name"]').val();

   var brand_id = $('input[name="brand_name"]').attr('brand_id');

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

	data:{brand_id:brand_id,brand_name:brand_name},

    url:'/brand/updateNamea',

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
</html>