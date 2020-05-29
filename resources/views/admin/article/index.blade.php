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
<h1 style="color:orange">文章列表<span style="float:right"><a class="btn btn-default" href="{{url('/article/create')}}"><font color='green'>添加</font></a></span></h1>
</center><hr/>

<form method="" action="" align="center">
		
         <select style="width:170px;height:26px;" name="cate_id" id="lastname">
						<option value="">请选择文章分类</option>
                        @foreach($articleclass as $v)
                        <option value="{{$v->cate_id}}"@if($v->cate_id==$cate_id) selected="selected"@endif>{{$v->cate_name}}</option>
						@endforeach
	    </select>
		文章标题:<input type="text" style="width:170px" name="name" id="firstname" value="{{$name}}" placeholder="请输入文章标题关键字">
		
		

		<button>搜索</button>
</form>
<table class="table">
	<caption>商品</caption>
	<thead>
		<tr class="danger">
			<th ><input type="checkbox">编号</th>
			<th>文章标题</th>
			<th>文章分类</th>
			<th>文章重要性</th>
			<th>是否显示</th>
            <th>文章作者</th>
			<th>作者Email</th>
			<th>关键字</th>
			<th>图片</th>
			<th>网页描述</th>
			<th>添加日期</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($article as $k=>$v)
		<tr @if($k%2==1)  class="danger" @else class="success" @endif>
		    <td><input type="checkbox">{{$v->article_id}}</td>
			<td>{{$v->article_title}}</td>
			<td>{{$v->cate_id}}</td>
			<td>{{$v->order_article==0?'普通':'置顶'}}</td>
			<td>{{$v->is_show==0?'√':'×'}}</td>
            <td>{{$v->article_man}}</td>
			<td>{{$v->article_email}}</td>
			<td>{{$v->article_key}}</td>
			<td>
			@if($v->article_img)
			<img width="50" src="{{env('UPLOADS_URL')}}{{$v->article_img}}">
			@endif
			</td>
			<td>{{$v->article_desc}}</td>
			<td>{{date("Y-m-d H:i:s",$v->article_time)}}</td>
			<td>
			<a class="btn btn-primary" href="{{url('/article/edit/'.$v->article_id)}}">编辑</a>|<a article_id="{{$v->article_id}}" class="btn btn-danger" href="javascript:void(0)">删除</a>
			</td>
		</tr>
		@endforeach
		<tr><td colspan="13" align="center">{{$article->appends(['name'=>$name,'cate_id'=>$cate_id])->links()}}</td></tr>
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

var article_id = $(this).attr("article_id");

if(confirm('你确定要删除此条记录吗？')){
//alert(admin_id);

$.get('/article/destroy/'+article_id,function(res){

//alert(res);
if(res.code=='0'){

location.href="/article";

}
},'json');
}
});
</script>