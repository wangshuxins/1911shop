     @extends('index.layouts.shop')
	 @section('title','首页')
     @section('content')
	 <div class="head-top">
      <img src="/static/index/images/sz.jpg" />
      <dl>
       <dt><a href="user.html"><img src="/static/index/images/kenan.jpg" /></a></dt>
       <dd>
        <h1 class="username">戏命傀儡师</h1>
        <ul>
         <li><a style="text-decoration:none" href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
         <li><a style="text-decoration:none" href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li><a style="background:none;" href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
		
       </dd>
	   &nbsp
       <div class="clearfix"></div>
	   
	<center>
	    <b><font color='red'>{{session('msg')}}</font></b>
	</center>
	
      </dl>
	 
     </div><!--head-top/-->
	  &nbsp
     <form action="#" method="get" class="search">
	
      <input type="text" class="seaText fl" />
	  
      <input type="submit" value="搜索" class="seaSub fr" />
	  
     </form><!--search/-->
	 
     <ul class="reg-login-click">
	 @if(session('requister'))
	 <li><a href="/login" style="text-decoration:none">欢迎[<font color='blue'>{{session('requister')->username}}</font>]登陆</a></li>
	  <li><a style="text-decoration:none" href="{{url('/logout')}}" class="rlbg">退出</a></li>
	 @else
	  <li><a style="text-decoration:none" href="{{url('/login')}}">登录</a></li>
      <li><a style="text-decoration:none" href="{{url('/register')}}" class="rlbg">注册</a></li>
	 @endif
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     <div id="sliderA" class="slider">
	 @if($slice)
	 @foreach($slice as $v)
      <a  href="{{url('/proinfo/'.$v->goods_id)}}"><img width="1000px" src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></a>
     @endforeach
	 @endif
     
     </div><!--sliderA/-->
     <ul class="pronav">
	 @if($slice)
	 @foreach($category as $v)
      <li><a style="text-decoration:none" href="{{url('/cate/'.$v->cate_id)}}">{{$v->cate_name}}</a></li>
     @endforeach
	 @endif
     <div class="clearfix"></div>
     </ul><!--pronav/-->


    <div class="index-pro1">
	 @if($shop)
	   @foreach($shop as $v)
      <div class="index-pro1-list">
	  
       <dl>
	  
        <dt><a href="{{url('/proinfo/'.$v->goods_id)}}"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></a></dt>
        <dd class="ip-text"><a href="{{url('/proinfo/'.$v->goods_id)}}">{{$v->goods_name}}</a><span>已售：{{$v->goods_price*$v->goods_number}}</span></dd>
        <dd class="ip-price"><strong>¥{{$v->goods_price*0.95}}</strong> <span>¥{{$v->goods_price}}</span></dd>
		
		
       </dl>
	
      </div>
	     @endforeach
		@endif
     <div class="clearfix"></div>



     </div><!--index-pro1/-->
     <div class="prolist">
	 @if($newshop)
	   @foreach($newshop as $v)
      <dl>
       <dt><a href="{{url('/proinfo/'.$v->goods_id)}}"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{url('/proinfo/'.$v->goods_id)}}">{{$v->goods_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$v->goods_price*0.95}}</strong> <span>¥{{$v->goods_price}}</span></div>
        <div class="prolist-yishou"><span>0.95折</span> <em>已售：{{$v->goods_price*$v->goods_number}}</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
	   @endforeach
		@endif
     
         
     </div><!--prolist/-->
     <div class="joins"><a href="fenxiao.html"><img src="/static/index/images/meigui.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是微商城底部信息</span></div>
	 @include('index.common.footer')
	 @endsection