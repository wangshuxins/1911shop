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
	<li><a>&nbsp &nbsp&nbsp &nbsp ༺ཌ欢迎<font color='red'>{{session('admin')->admin_name}}</font>登陆༈ད༻</a><li>
	</ul>
</div>
</div>
</nav>

<center>
<h2 style="color:orange">商品品牌列表<span style="float:right"><a class="btn btn-default" href="{{url('/brand/create')}}"><font color='green'>添加</font></a></span></h2>
</center><hr/>
<form method="" action="" align="center">
		
		品牌名称:<input type="text" style="width:170px" name="brand_name" id="firstname" value="{{$brand_name}}" placeholder="品牌名称">
		
		

		<button>搜索</button>
</form>
<table class="table">
	<caption>品牌</caption>
	<thead>
		<tr>
			<th>品牌ID</th>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌LOGO</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($brand as $k=>$v)
		<tr @if($k%2==1)  class="danger" @else class="success" @endif>
		    <td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_url}}</td>
			<td>
			@if($v->brand_logo)
			<img width="50" src="{{env('UPLOADS_URL')}}{{$v->brand_logo}}">
			@endif
			</td>

			<td>
			<a class="btn btn-primary" href="{{url('/brand/edit/'.$v->brand_id)}}">编辑</a>|<a class="btn btn-danger" brand_id="{{$v->brand_id}}" href="javascript:void(0)">删除</a>
			</td>
		</tr>
		@endforeach
		<tr><td colspan="5" align="center">{{$brand->appends(['brand_name'=>$brand_name])->links()}}</td></tr>
	</tbody>
</table>

</body>
</html>
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

var brand_id = $(this).attr("brand_id");

if(confirm('你确定要删除此条记录吗？')){
//alert(admin_id);

$.get('/brand/destroy/'+brand_id,function(res){

//alert(res);
if(res.code=='0'){

location.href="/brand";

}
},'json');
}
});
</script>