     @extends('index.layouts.shop')
	 @section('title','注册页面')
     @section('content')
<header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1><font color='orange'>会员注册</font></h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
	 <b style="color:red">{{session('msg')}}</b>
     <form action="{{url('/doregister')}}" method="post" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
     @csrf
	  <div class="lrBox">
       <div class="lrList"><input type="text" placeholder="输入手机号码或者邮箱号" name="username" />
	   <b style="color:red">{{$errors->first('username')}}</b>
	    </div>
	  
       <div class="lrList2"><input type="text" placeholder="输入短信验证码" name="code"/> 
	   
	   <button type="button" id="button_id">获取验证码</button>
	   <b style="color:red">{{$errors->first('code')}}</b>
	   </div>
	   
       <div class="lrList"><input type="password" placeholder="设置新密码（6-18位数字或字母）" name="pwd"/>
	    <b style="color:red">{{$errors->first('pwd')}}</b>
	   </div>
	  
       <div class="lrList"><input type="password" placeholder="再次输入密码" name="repwd"/>
	   <b style="color:red">{{$errors->first('repwd')}}</b>
	   </div>
	   
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" value="立即注册" id="button" />
      </div>
	  @include('index.common.footer')
	  <script>
	  $("button").click(function(){

		   var emailreg = /^\d{3,10}@qq(\.)com$/;

	  var telreg = /^1[3|4|5|6|7|8|9]\d{9}$/;

      var username = $('input[name="username"]').val();

	  //alert(username);
    
     $('input[name="username"]').next().empty();
    
	if(!(telreg.test(username)||emailreg.test(username))){
	  
	   
     $('input[name="username"]').next().text('手机号或者邮箱格式不正确!');
	 return;

	 }

   var flag = true;

   $.ajaxSetup({headers:{
   
   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
   }
   })
   $.ajax({

	type:'post',

	data:{username:username},

    url:'checkName',

	async:false,
	
	success:function(msg){
	
	if(msg>0){
	
	$('input[name="username"]').next().text('用户名已存在s!');
	flag = false;
	}
	}


   });
    if(!flag) return;
	   //alert('1234');
	  var  _this = $(this);
     
	  var username = $('input[name="username"]').val();

	  var emailreg = /^\d{3,10}@qq(\.)com$/;

	  var telreg = /^1[3|4|5|6|7|8|9]\d{9}$/;
	 

      if(telreg.test(username)){
	  
	    $.get('/sendSms',{username:username},function(res){
		
		alert(res.msg);return;
		
		
		},'json');



	 }else if(emailreg.test(username)){
	  
	    $.get('/sendEmail',{username:username},function(res){
		
		alert(res.msg);return;
		
		
		},'json');

	  }else{
	  
	  alert('请输入正确的手机号或者邮箱');return;
	  
	  }
	  });
$('input[name="username"]').blur(function(){

	//alert('1234');

      var emailreg = /^\d{3,10}@qq(\.)com$/;

	  var telreg = /^1[3|4|5|6|7|8|9]\d{9}$/;

      var username = $(this).val();

	  //alert(username);
    
     $(this).next().empty();
    
	if(!(telreg.test(username)||emailreg.test(username))){
	  
	   
     $('input[name="username"]').next().text('手机号或者邮箱格式不正确!');
	 return;

	 }

	  $.ajaxSetup({headers:{
   
   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
   
   }
   })
   
   $.post('/checkName',{username:username},function(res){
   
  if(res>0){
  
  $('input[name="username"]').next().text('用户名已存在!');return;
 
  
     }
   });
    

 });

 $('input[name="code"]').blur(function(){



 var code = $('input[name="code"]').val();

 
 $(this).next().text('√');
  
 
 if(code==''){
 
  $('input[name="code"]').next().text('验证码不能为空!');

  return;
 
 }else if(!(/^\d{6}$/.test(code))){
 
 $('input[name="code"]').next().text('验证码格式不正确!');

  return;

 }
});

$('input[name="pwd"]').blur(function(){



 var pwd = $('input[name="pwd"]').val();

 
 $(this).next().empty();
  
 
 if(pwd==''){
 
  $('input[name="pwd"]').next().text('注册密码不能为空!');

  return;
 
 }else if(!(/^[0-9a-zA-Z]{6,12}$/.test(pwd))){
 
 $('input[name="pwd"]').next().text('注册密码格式不正确!');

  return;

 }
});


$('input[name="repwd"]').blur(function(){

$(this).next().empty();

 var pwd = $('input[name="pwd"]').val();

  var repwd = $('input[name="repwd"]').val();

 
 if(repwd==''){
 
  $('input[name="repwd"]').next().text('管理员密码不能为空!');

  return;
 
 }else if(repwd!=pwd){
 
 $('input[name="repwd"]').next().text('两次密码不一致!');

  return;


 }
});



 $("#button").click(function(){

	 
      var emailreg = /^\d{3,10}@qq(\.)com$/;

	  var telreg = /^1[3|4|5|6|7|8|9]\d{9}$/;

      var username = $('input[name="username"]').val();

	  //alert(username);
    
     $('input[name="username"]').next().empty();
    
	if(!(telreg.test(username)||emailreg.test(username))){
	  
	   
     $('input[name="username"]').next().text('手机号或者邮箱格式不正确!');
	 return;

	 }

   var flag = true;

   $.ajaxSetup({headers:{
   
   'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
   }
   })
   $.ajax({

	type:'post',

	data:{username:username},

    url:'checkName',

	async:false,
	
	success:function(msg){
	
	if(msg>0){
	
	$('input[name="username"]').next().text('用户名已存在s!');
	flag = false;
	}
	
	}


   });
    if(!flag) return;

  var code = $('input[name="code"]').val();

 
 $('input[name="code"]').next().text("√");
  
 
 if(code==''){
 
  $('input[name="code"]').next().text('验证码不能为空!');

  return;
 
 }else if(!(/^\d{6}$/.test(code))){
 
 $('input[name="code"]').next().text('验证码格式不正确!');

  return;

 }

 



 var pwd = $('input[name="pwd"]').val();

 
 $(this).next().empty();
  
 
 if(pwd==''){
 
  $('input[name="pwd"]').next().text('注册密码不能为空!');

  return;
 
 }else if(!(/^[0-9a-zA-Z]{6,18}$/.test(pwd))){
 
 $('input[name="pwd"]').next().text('注册密码格式不正确!');

  return;

 }

$('input[name="repwd"]').next().empty();

 var pwd = $('input[name="pwd"]').val();

  var repwd = $('input[name="repwd"]').val();

 
 if(repwd==''){
 
  $('input[name="repwd"]').next().text('管理员确认密码不能为空!');

  return;
 
 }else if(repwd!=pwd){
 
 $('input[name="repwd"]').next().text('两次密码不一致!');

  return;


 }

   $('form').submit();
});
	
	  </script>
	   @endsection