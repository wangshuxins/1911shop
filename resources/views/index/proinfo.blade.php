<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="/static/index/images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="/static/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/index/css/style.css" rel="stylesheet">
    <link href="/static/index/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond./static/index/js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
  
 
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
	@foreach($goods_id as $v)
	@if($v->goods_imgs)
	 @php $imgarr = explode('|',$v->goods_imgs);@endphp
			@foreach($imgarr as $img)
			<img src="{{env('UPLOADS_URL')}}{{$img}}" width="50">
	        @endforeach
	@endif
	@endforeach
     </div><!--sliderA/-->
     <table class="jia-len">
	  @if($goods_id)
	 @foreach($goods_id as $v)
      <tr  goods_number="{{$v->goods_number}}" goods_id="{{$v->goods_id}}">
       <th><strong class="orange">{{$v->goods_price}}</strong></th>
       <td align="right">
	   <input type="button" style="background-color:red;border:none;height:27px" id="－" value="－" /><input type="text" id="text" style="width:66px;text-align:center;" value="1"  /><input type="button" style="background-color:blue;border:none;height:27px" value="＋" id="＋"/>
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$v->goods_name}}</strong>
		
        <p class="hui">{{$v->goods_desc}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>

	   @endforeach
	  
	 @endif
	 
     </table>
	 <br>
	  <tr><td><h6 style="float:center"><font color='orange' >当前访问量是：</font><font color="red">{{$visit}}</font></h6></td></tr>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a  style="text-decoration:none" href="javascript:;">50ML</a></li>
      <li><a style="text-decoration:none" href="javascript:;">100ML</a></li>
      <li><a  style="text-decoration:none" href="javascript:;">150ML</a></li>
      <li><a  style="text-decoration:none" href="javascript:;">200ML</a></li>
      <li><a  style="text-decoration:none" href="javascript:;">300ML</a></li>
	   <li><a  style="text-decoration:none" href="javascript:;">400ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a style="text-decoration:none" href="javascript:;" class="zhaiCur">商品简介</a>
      <a style="text-decoration:none" href="javascript:;">商品参数</a>
      <a style="text-decoration:none" href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="/static/index/images/image4.jpg" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="javascript:void(0)" style="text-decoration:none" id="by_car">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
	@include('index.common.footer')
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/static/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/index/js/style.js"></script>
    <!--焦点轮换-->
    <script src="/static/index/js/jquery.excoloSlider.js"></script>
	 <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
	  <!--jq加减-->
    <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
   <script>
   //点击加号
	$("#＋").on("click",function(){
	//alert('加');

	var _this = $(this);

	var buy_number = parseInt(_this.prev("input").val());

	//alert(buy_number);

	var goods_number = parseInt(_this.parents("tr").attr("goods_number"));

	//alert(goods_number);

	if(buy_number<goods_number){
	
     buy_number = buy_number+1;

	 _this.prev("input").val(buy_number);

	 _this.css("background-color","orange");

	 $("#－").css("background-color","red");
	
	}

	});

	 //点击减号
	$("#－").on("click",function(){
	//alert('减');

	var _this = $(this);

	var buy_number = parseInt(_this.next("input").val());


	//alert(goods_number);

	if(buy_number>1){
	
     buy_number = buy_number-1;

	 _this.next("input").val(buy_number);

	 _this.css("background-color","purple");

	 $("#＋").css("background-color","blue");
	
	}


	});

	//失去焦点
     $("#text").blur(function(){

       var _this = $(this);

       var buy_number = _this.val();

	    $("#＋").css("background-color","blue");

		 $("#－").css("background-color","red");

       var goods_number = parseInt(_this.parents("tr").attr("goods_number"));


       if(buy_number==''||parseInt(buy_number)<1||(!/^\d+$/.test(buy_number))){
	
         _this.val(1);

	    }else if(parseInt(buy_number)>goods_number){
	
	      _this.val(goods_number);
	
	
	      }else{
	
	    _this.val(parseInt(buy_number));
	
	   }
       
    });

	$(document).on('click',"#by_car",function(){

		

var goods_id = $("#＋").parents("tr").attr("goods_id");

//alert(goods_id);return;

var buy_number = parseInt($("#text").val());

//alert(buy_number);return;

//console.log(goods_id,buy_num);

$.ajax({

url :"{{url('/buycar')}}",

data : {'goods_id':goods_id,'buy_number':buy_number},

dataType :'json',

type : 'get',

success : function(res){

if(res.error_no == 0){

var go = confirm('此宝贝已加入购物车，是否进行结算');

if(go == true){

location.href="/car";

}

}else if(res.error_no==6){

if(confirm('您当前还未登录，是否进行登陆')){

location.href = "/login?refer="+location.href;

}
}else if(res.error_no == 1){

        alert(res.error_msg);

}
}
});
});

	</script>
  </body>
</html>