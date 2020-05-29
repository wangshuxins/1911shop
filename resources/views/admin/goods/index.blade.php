<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bootstrap 实例 - 上下文类</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
	<li><a style="text-decoration:none;"  href="{{url('/login/logout')}}"><font color='red'>退出</font></a></li>
    <li><a>&nbsp &nbsp &nbsp &nbsp ༺ཌ欢迎<font color='red'>{{session('admin')->admin_name}}</font>登陆༈ད༻</a><li>
	</ul>
</div>
</div>
</nav>

<center>
<h1 style="color:orange">商品列表<span style="float:right"><a class="btn btn-default" href="{{url('/goods/create')}}"><font color='green'>添加</font></a></span></h1>
</center><hr/>

<form method="" action="" align="center">
		<input type="text" style="width:170px" name="name" id="firstname" value="{{$name}}" placeholder="请输入商品名称关键字">
        <select style="width:170px;height:26px;" name="cate_id" id="lastname">
						<option value="">请选择商品分类</option>
						@foreach($cate as $v)
                        <option value="{{$v->cate_id}}" @if($v->cate_id==$cate_id) selected="selected"@endif>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
						@endforeach
	    </select>
		<select style="width:170px;height:26px;" name="brand_id" id="lastname">
						<option value="">请选择商品品牌</option>
						@foreach($brand as $v)
                        <option value="{{$v->brand_id}}" @if($v->brand_id==$brand_id) selected="selected"@endif>{{$v->brand_name}}</option>
						@endforeach
	    </select>
		<input type="text" style="width:170px" name="min_price" id="firstname" value="{{$min_price}}" placeholder="请输入大于此商品价格">--<input type="text" style="width:170px" name="max_price" id="firstname" value="{{$max_price}}" placeholder="请输入小于商品价格">

		<button>搜索</button>
</form>
<table class="table">
	<caption>商品</caption>
	<thead>
		<tr>
			<th>商品ID</th>
			<th>商品名称</th>
			<th>商品代号</th>
			<th>商品分类</th>
            <th>商品品牌</th>
			<th>商品价格</th>
			<th>商品库存</th>
			<th>是否显示</th>
			<th>是否新品</th>
			<th>是否精品</th>
		    <th>是否首页幻灯片</th>
			<th>商品主图</th>
			<th>商品相册</th>
			<th>商品详情</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($goods as $k=>$v)
		<tr @if($k%2==1)  class="danger" @else class="success" @endif>
		    <td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_sn}}</td>
			<td>{{$v->cate_name}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_number}}</td>
			<td>{{$v->is_show==0?'否':'是'}}</td>
			<td>{{$v->is_new==0?'否':'是'}}</td>
			<td>{{$v->is_best==0?'否':'是'}}</td>
			<td>{{$v->is_slice==0?'否':'是'}}</td>
			<td>
			@if($v->goods_img)
			<img width="50" src="{{env('UPLOADS_URL')}}{{$v->goods_img}}">
			@endif
			</td>
			
            <td>
			@if($v->goods_imgs)
			@php $imgarr = explode('|',$v->goods_imgs);@endphp
			@foreach($imgarr as $img)
			<img src="{{env('UPLOADS_URL')}}{{$img}}" width="50">
			@endforeach
			@endif
			</td>
			<td>{{$v->goods_desc}}</td>
			<td>
			<a class="btn btn-primary" href="{{url('/goods/edit/'.$v->goods_id)}}">编辑</a>|<a class="btn btn-danger" goods_id="{{$v->goods_id}}" href="javascript:void(0)">删除</a>
			</td>
		</tr>
		@endforeach
		<tr><td colspan="13" align="center">{{$goods->appends(['name'=>$name,'cate_id'=>$cate_id,'brand_id'=>$brand_id,'min_price','max_price'])->links()}}</td></tr>
	</tbody>
</table>
<script>
$(document).on("click",'.page-item a',function(){
//alert('1234');

var url = $(this).attr('href');

$.get(url,function(res){
  
  $('tbody').html(res);

});
return false;
});

$('.btn-danger').click(function(res){

var goods_id = $(this).attr("goods_id");

if(confirm('你确定要删除此条记录吗？')){
//alert(admin_id);

$.get('/goods/destroy/'+goods_id,function(res){

//alert(res);
if(res.code=='0'){

location.href="/goods";

}
},'json');
}
});
</script>
</body>
</html>
<!-- <script>
$(document).on("click",'.page-item a',function(){
//alert('1234');

var url = $(this).attr('href');

$.get(url,function(res){
  
  $('tbody').html(res);

});
return false;
});
</script> -->