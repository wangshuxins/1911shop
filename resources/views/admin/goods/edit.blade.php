<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 微商城后台 - 商品</title>
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
<h1 style="color:red">商品管理<span style="float:right"><a class="btn btn-default" href="{{url('/goods')}}">列表</a></span></h1>
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
<form class="form-horizontal" role="form" method="post" action="{{url('/goods/update/'.$goods->goods_id)}}" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="goods_name" id="firstname" 
				   value="{{$goods->goods_name}}" placeholder="请输入商品名称" goods_id="{{$goods->goods_id}}">
		     <b style="color:red">{{$errors->first('goods_name')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品代号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="goods_sn" id="firstname" 
				  value="{{$goods->goods_sn}}" placeholder="请输入商品代号">
		     <b style="color:red">{{$errors->first('goods_sn')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品分类</label>
		<div class="col-sm-10">
			        <select class="form-control" style="width:900px" name="cate_id" id="lastname">
						<option value="">请选择</option>
                        @foreach($cate as $v)
                        <option value="{{$v->cate_id}}" @if($v->cate_id==$goods->cate_id) selected @endif>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
						@endforeach	 
			        </select>
					<b style='color:red'>{{$errors->first('cate_id')}}</b>
				    
		</div>
		
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品品牌</label>
		<div class="col-sm-10">
			        <select class="form-control" style="width:900px" name="brand_id" id="lastname">
						<option value="">请选择</option>
                         @foreach($brand as $v)
                        <option value="{{$v->brand_id}}" @if($v->brand_id==$goods->brand_id) selected @endif>{{$v->brand_name}}</option>
						@endforeach	
			        </select>
				    <b style='color:red'>{{$errors->first('brand_id')}}</b> 
		</div>
		
	</div>
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="goods_price" id="firstname" 
				 value="{{$goods->goods_price}}"  placeholder="请输入商品价格">
		     <b style="color:red">{{$errors->first('goods_price')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="goods_number" id="firstname" 
				 value="{{$goods->goods_number}}"  placeholder="请输入商品库存">
		     <b style="color:red">{{$errors->first('goods_number')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
		@if($goods->is_show == '0')
			<input type="radio"  name="is_show" id="lastname" value="1" >是
			<input type="radio"  name="is_show" id="lastname" value="0" checked>否
		@else
		   <input type="radio"  name="is_show" id="lastname" value="1" checked>是
		   <input type="radio"  name="is_show" id="lastname" value="0">否
		@endif   
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-10">
		@if($goods->is_new == '0')
			<input type="radio" name="is_new" id="lastname" value="1">是
			<input type="radio" name="is_new" id="lastname" value="0" checked>否
		@else
           <input type="radio" name="is_new" id="lastname" value="1" checked>是
			<input type="radio" name="is_new" id="lastname" value="0">否
		@endif
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
		@if($goods->is_best == '0')
			<input type="radio"   name="is_best" id="lastname" value="1">是
			<input type="radio"   name="is_best" id="lastname" value="0" checked>否
		@else
            <input type="radio"   name="is_best" id="lastname" value="1" checked>是
			<input type="radio"   name="is_best" id="lastname" value="0">否
		@endif
		</div>
	</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否首页幻灯片</label>
		<div class="col-sm-10">
		@if($goods->is_slice == '0')
			<input type="radio"   name="is_slice" id="lastname" value="1">是
			<input type="radio"   name="is_slice" id="lastname" value="0" checked>否
		@else
		    <input type="radio"   name="is_slice" id="lastname" value="1" checked>是
			<input type="radio"   name="is_slice" id="lastname" value="0">否
		@endif
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品主图</label>
		<div class="col-sm-3">
			<input type="file" class="form-control"  name="goods_img" id="lastname">
		</div>
        @if($goods->goods_img)
			<img width="50" src="{{env('UPLOADS_URL')}}{{$goods->goods_img}}">
		@endif
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-3">
			<input type="file" class="form-control"  multiple="multiple" name="goods_imgs[]" id="lastname">
		</div>
		@if($goods->goods_imgs)
			@php $imgarr = explode('|',$goods->goods_imgs);@endphp
			@foreach($imgarr as $img)
			<img src="{{env('UPLOADS_URL')}}{{$img}}" width="50">
			@endforeach
		@endif
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品详情</label>
		<div class="col-sm-10">
			<textarea name="goods_desc" style="width:600px;height:150px" rows="" cols="">{{$goods->goods_desc}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default">修改</button>
		</div>
	</div>
</form>
<script>

$('input[name="goods_name"]').blur(function(){

   var goods_name = $(this).val();

    var goods_id = $(this).attr("goods_id");
    
     $(this).next().empty();

  if(!(/^[\u4e00-\u9fa5}\w]{2,60}$/.test(goods_name))){
  
     $(this).next().text('商品名称格式不正确');
	 return;
   }

    $.ajaxSetup({headers:{
   
   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
   
   }
   })
   $.post('/goods/updateNamec',{goods_id:goods_id,goods_name:goods_name},function(res){
   
  if(res>0){
  
  $('input[name="goods_name"]').next().text('商品名称已存在!');
 
  
     }
   });
 });


 $('input[name="goods_sn"]').blur(function(){



 var goods_sn = $('input[name="goods_sn"]').val();

 
 $(this).next().empty();
  
 
 if(goods_sn==''){
 
  $('input[name="goods_sn"]').next().text('商品代号不能为空!');

  return;
 
 }
});


$('select[name="cate_id"]').blur(function(){



 var cate_id = $('select[name="cate_id"]').val();

 
 $(this).next().empty();
  
 
 if(cate_id==''){
 
  $('select[name="cate_id"]').next().text('商品分类不能为空!');

  return;
 
 }

});


$('select[name="brand_id"]').blur(function(){



 var brand_id = $('select[name="brand_id"]').val();

 
 $(this).next().empty();
  
 
 if(brand_id==''){
 
  $('select[name="brand_id"]').next().text('商品品牌不能为空!');

  return;
 
 }

});

$('input[name="goods_price"]').blur(function(){



 var goods_price = $('input[name="goods_price"]').val();

 
 $(this).next().empty();
  
 
 if(goods_price==''){
 
  $('input[name="goods_price"]').next().text('商品价格不能为空!');

  return;
 
 }else if(!(/^\d+$/.test(goods_price))){
 
 $('input[name="goods_price"]').next().text('商品价格必须是数字!');

  return;

 }
});


$('input[name="goods_number"]').blur(function(){

 var goods_number = $('input[name="goods_number"]').val();

 $(this).next().empty();

if(goods_number==''){
 
  $('input[name="goods_number"]').next().text('商品库存不能为空!');

  return;
 
 }else if(!(/^\d+$/.test(goods_number))){
 
 $('input[name="goods_number"]').next().text('商品库存必须是数字!');

  return;

 }else if(goods_number>10000000){
 
 $('input[name="goods_number"]').next().text('商品库存不能大于千万!');
 
 return;

}
});



 $("button").click(function(){

   var goods_id = $('input[name="goods_name"]').attr("goods_id");

   var goods_name = $('input[name="goods_name"]').val();

  if(!(/^[\u4e00-\u9fa5}\w]{2,60}$/.test(goods_name))){
  
    $('input[name="goods_name"]').next().text('商品名称格式不正确');
	 return;
   }
   var flag = true;
   $.ajaxSetup({headers:{
   
   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
   }
   })
   $.ajax({

	type:'post',

	data:{goods_id:goods_id,goods_name:goods_name},

    url:'/goods/updateNamec',

	async:false,
	
	success:function(msg){
	
	if(msg>0){
	
	$('input[name="goods_name"]').next().text('商品名称已存在s!');
	flag = false;
	}
	}
   });
  if(!flag) return;

   var goods_sn = $('input[name="goods_sn"]').val();

 
 $('input[name="goods_sn"]').next().empty();
  
 
 if(goods_sn==''){
 
  $('input[name="goods_sn"]').next().text('商品代号不能为空!');

  return;
 
 }

  var cate_id = $('select[name="cate_id"]').val();

 
 $('select[name="cate_id"]').next().empty();
  
 
 if(cate_id==''){
 
  $('select[name="cate_id"]').next().text('商品分类不能为空!');

  return;
 
 }

 var brand_id = $('select[name="brand_id"]').val();

 
 $('select[name="brand_id"]').next().empty();
  
 
 if(brand_id==''){
 
  $('select[name="brand_id"]').next().text('商品品牌不能为空!');

  return;
 
 }

 var goods_price = $('input[name="goods_price"]').val();

 
 $('input[name="goods_price"]').next().empty();
  
 
 if(goods_price==''){
 
  $('input[name="goods_price"]').next().text('商品价格不能为空!');

  return;
 
 }else if(!(/^\d+$/.test(goods_price))){
 
 $('input[name="goods_price"]').next().text('商品价格必须是数字!');

  return;

 }

  var goods_number = $('input[name="goods_number"]').val();

 $('input[name="goods_number"]').next().empty();

if(goods_number==''){
 
  $('input[name="goods_number"]').next().text('商品库存不能为空!');

  return;
 
 }else if(!(/^\d+$/.test(goods_number))){
 
 $('input[name="goods_number"]').next().text('商品库存必须是数字!');

  return;

 }else if(goods_number>10000000){
 
 $('input[name="goods_number"]').next().text('商品库存不能大于千万!');
 
 return;

}

  $('form').submit();
});


</script>
</body>
</html>