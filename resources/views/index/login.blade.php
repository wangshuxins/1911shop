@extends('index.layouts.shop')
	 @section('title','登陆页面')
     @section('content')
<header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1><font color="green">会员登陆</font></h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
	 <b style="color:red">{{session('msg')}}</b>
     <form action="{{url('/dologin')}}" method="post" class="reg-login">
      <h3>还没有三级分销账号？点此<a class="orange" href="{{url('/register')}}">注册</a></h3>
	   @csrf
	   <input type="hidden" name="refer" @if(isset(request()->refer)) value="{{request()->refer}}" @endif>
      <div class="lrBox">
       <div class="lrList">
	   <input type="text" name="username" placeholder="输入手机号码或者邮箱号" />
	   <b style="color:red">{{$errors->first('username')}}</b>
	   </div>
       <div class="lrList">
	   <input type="password"name="pwd" placeholder="输入密码" />
       <b style="color:red">{{$errors->first('pwd')}}</b>
	   </div>
      </div><!--lrBox/-->
	<div class="form-group">
		<div class="col-sm-4 col-sm-5">
		<div class="checkbox">
		<label>
			<input type="checkbox" name="isremember">十天免登录
		</label>
		</div>
		</div>
	</div>
	
      <div class="lrSub">
       <input type="button" id="button" value="立即登录" />
      </div>
     </form><!--reg-login/-->
	 @include('index.common.footer')
     <script>

	 $('input[name="username"]').blur(function(){
	 
	      var _this = $(this);

		  $(this).next().empty();
 
	      var username = $(this).val();
  
	      if(username == ''){
	    
		     
	         $(this).next().text('请填写用户名');return;
               
	     }
	 });

	 $('input[name="pwd"]').blur(function(){
	 
	 var _this = $(this);

	 $(this).next().empty();

	 var pwd = $(this).val();

	      if(pwd == ''){
	    
		     
	         $(this).next().text('请填写密码');return;
               
	     }
	 });

	 $("#button").click(function(){
	 
     var username = $('input[name="username"]').val();

	    $('input[name="username"]').next().empty(); 
         
	      if(username == ''){
	    		     
	        $('input[name="username"]').next().text('请填写用户名');
			return;
               
	     }

	 var pwd = $('input[name="pwd"]').val();

	  $('input[name="pwd"]').next().empty(); 
  
	      if(pwd == ''){
	    		     
	        $('input[name="pwd"]').next().text('请填写密码');return;
               
	     }
     
	 $('form').submit();
	 
	 });
	 </script>
	  @endsection