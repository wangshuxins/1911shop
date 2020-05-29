<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bootstrap 微商城后台 - 品牌</title>
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
<h2 style="color:orange">分类列表<span style="float:right"><a class="btn btn-default" href="{{url('/category/create')}}"><font color='green'>添加</font></a></span></h2>
</center><hr/>

<table class="table">
	<caption>品牌</caption>
	<thead>
		<tr align="center">
			<th>分类ID</th>
			<th>分类名称</th>
			<th>是否显示</th>
			<th>是否在导航栏显示</th>
            <th>分类描述</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($res as $k=>$v)
		<tr  @if($k%2==1)  class="danger" @else class="success" @endif>
		    <td>{{$v->cate_id}}</td>
			<td>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</td>
            <td>{{$v->cate_show==1?'是':'否'}}</td>
			<td>{{$v->cate_nav_show==1?'是':'否'}}</td>
			<td>{{$v->cate_desc}}</td>
			<td>
			<a class="btn btn-primary" href="{{url('/category/edit/'.$v->cate_id)}}">编辑</a>|<a class="btn btn-danger" cate_id="{{$v->cate_id}}" href="javascript:void(0)">删除</a>
			</td>
		</tr>
		@endforeach
		
	</tbody>
</table>
<script>
$('.btn-danger').click(function(res){

var cate_id = $(this).attr("cate_id");

if(confirm('你确定要删除此条记录吗？')){
//alert(admin_id);

$.get('/category/destroy/'+cate_id,function(res){

//alert(res);
if(res.code=='0'){

location.href="/category";

}
},'json');
}
});

</script>
</body>
</html>