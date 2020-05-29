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
<h1 style="color:red">文章添加<span style="float:right"><a class="btn btn-default" href="{{url('/article')}}">列表</a></span></h1>
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
<form class="form-horizontal" role="form" method="post" action="{{url('/article/store')}}" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="article_title" id="firstname" 
				   placeholder="请输入文章标题">
		     <b style="color:red">{{$errors->first('article_title')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-10">
			        <select class="form-control" style="width:900px" name="cate_id" id="lastname">
						<option value="">请选择</option>
                        @foreach($arr as $v)
                        <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
						@endforeach
			        </select>
				    <b style='color:red'>{{$errors->first('cate_id')}}</b> 
		</div>
		
	</div>
	
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-10">
			<input type="radio" name="order_article" id="lastname" value="0" checked>普通
			<input type="radio" name="order_article" id="lastname" value="1">置顶
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_show" id="lastname" value="0"  checked>显示
			<input type="radio"  name="is_show" id="lastname" value="1">不显示
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="article_man" id="firstname" 
				   placeholder="请输入文章作者">
		     <b style="color:red">{{$errors->first('article_man')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">作者email</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="article_email" id="firstname" 
				   placeholder="请输入作者email">
		     <b style="color:red">{{$errors->first('article_email')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" style="width:900px" name="article_key" id="firstname" 
				   placeholder="关键字">
		     <b style="color:red">{{$errors->first('article_key')}}</b> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-10">
			<textarea name="article_desc" style="width:600px;height:150px" rows="" cols=""></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" style="width:900px" name="article_img" id="lastname">
		</div>
		
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default">添加</button>
		</div>
	</div>
</form>
<script>

$('input[name="article_title"]').blur(function(){

   var article_title = $(this).val();

     $(this).next().empty();

  if(!(/^[\u4e00-\u9fa5}\w]{2,60}$/.test(article_title))){
  
     $(this).next().text('文章标题格式不正确');
	 return;
   }
   $.ajaxSetup({headers:{
   
   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
   
   }
   })
   $.post('/article/checkName',{article_title:article_title},function(res){
   
  if(res>0){
  
  $('input[name="article_title"]').next().text('文章标题已存在!');
 
  
     }
   });

 });

$('select[name="cate_id"]').blur(function(){



 var cate_id = $('select[name="cate_id"]').val();

 
 $(this).next().empty();
  
 
 if(cate_id==''){
 
  $('select[name="cate_id"]').next().text('文章分类不能为空!');

  return;
 
 }

});


$('input[name="article_man"]').blur(function(){

  $(this).next().empty();
  
 var article_man = $('input[name="article_man"]').val();


 if(article_man==''){
 
  $('input[name="article_man"]').next().text('文章作者不能为空!');

  return;
 
 }
});


$('input[name="article_email"]').blur(function(){

 $(this).next().empty();
  

 var article_email =  $('input[name="article_email"]').val();

 if(article_email==''){
 
  $('input[name="article_email"]').next().text('作者email不能为空!');

  return;
 
 }

});


$('input[name="article_key"]').blur(function(){

 
   $(this).next().empty();


 var article_key =  $('input[name="article_key"]').val();

 if(article_key==''){
 
  $('input[name="article_key"]').next().text('关键字不能为空!');

  return;
 
 }
});

$("button").click(function(){

	 
   var article_title = $('input[name="article_title"]').val();

  if(!(/^[\u4e00-\u9fa5}\w]{2,60}$/.test(article_title))){
  
    $('input[name="article_title"]').next().text('文章标题格式不正确');
	 return;
   }
   var flag = true;
   $.ajaxSetup({headers:{
   
   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
   }
   })
   $.ajax({

	type:'post',

	data:{article_title:article_title},

    url:'/article/checkName',

	async:false,
	
	success:function(msg){
	
	if(msg>0){
	
	$('input[name="article_title"]').next().text('文章标题已存在s!');
	flag = false;
	}
	}
   });
  if(!flag) return;
   

 var cate_id = $('select[name="cate_id"]').val();
 
 if(cate_id==''){
 
  $('select[name="cate_id"]').next().text('文章分类不能为空!');
  return;
 }

  var article_man = $('input[name="article_man"]').val();


 if(article_man==''){
 
  $('input[name="article_man"]').next().text('文章作者不能为空!');

  return;
 
 }

 var article_email =  $('input[name="article_email"]').val();

 if(article_email==''){
 
  $('input[name="article_email"]').next().text('作者email不能为空!');

  return;
 
 }

 var article_key =  $('input[name="article_key"]').val();

 if(article_key==''){
 
  $('input[name="article_key"]').next().text('关键字不能为空!');

  return;
 
 }
  $('form').submit();
});
</script>
</body>
</html>