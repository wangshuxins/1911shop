@extends('index.layouts.shop')
	 @section('title','列表页')
     @section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
	
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$sum}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
	  
     </table>
	
	 <br>
   <div>
       <h6>
	   <a href="javascript:void(0)" id="delMany" style="text-decoration:none;float:right;">删除选中商品</a>
		</h6>
       <tr>
        <td width="100%" colspan="4"><a style="text-decoration:none"  href="javascript:;"><input type="checkbox" id="all" name="1" /> 全选</a></td>
       </tr>
	</div>
     <div class="dingdanlist">
      <table>
	  @if($bycar)
	  @foreach($bycar as $k=>$v)
	 
	  
       <tr goods_number="{{$v->goods_number}}" goods_id="{{$v->goods_id}}">
        <td width="4%"><input class="box" type="checkbox" name="1" /></td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{date('Y-m-d H:i',$v->buy_time)}}</time>
        </td>
        <td align="right"> <input type="button" style="background-color:red;border:none;height:27px" class="less" value="－" /><input type="text" id="text" class="buy_number" style="width:66px;text-align:center;" value="{{$v->buy_number}}"  /><input type="button" style="background-color:blue;border:none;height:27px" value="＋" class="＋"/></td>
		<td><a style="text-decoration:none" class="del" href="javascript:void(0)">×</a></td>
       </tr>

       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->goods_price*$v->buy_number}}</strong></th>
       </tr>
	   
	    @endforeach
	    @endif($bycar)
		
		
      </table>
     </div><!--dingdanlist/-->
     
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%" id="money">总计：<strong class="orange">¥0</strong></td>
       <td width="40%"><a style="text-decoration:none" href="pay.html" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/static/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/index/js/style.js"></script>
    <!--jq加减-->
    <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script> 
 <script>
 //自动加载事件
 $(function(){
 //点击加号 	
    $(document).on("click",".＋",function(){
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

	 _this.parents("tr").find(".box").prop("checked",true);

	_this.parents("tr").css('background-color','gray');


	 $(".less").css("background-color","red");

	 changeNum(_this,buy_number);

	
	getTotal(_this);

	getMoney();
	
	}
	});

    //计算商品数量乘以价格
	function changeNum(_this,buy_number){
	
	var goods_id = _this.parents("tr").attr("goods_id");

	//alert(goods_id);

	$.ajax({

    url:"{{url('/changeNumber')}}",
	
    data:{'goods_id':goods_id,'buy_number':buy_number},
	
	type : 'get',

	dataType : 'json',

	async : false,

	success:function(res){
	
	if(res.error_no==0){
	
	console.log(res);
	
	}else{
	
	console.log(res.error_msg);
	
	}
	}
	});
	}

    //此条商品总金额
	function getTotal(_this){
	
	var goods_id = _this.parents("tr").attr("goods_id");

	//console.log(goods_id);

	$.ajax({

     url:"{{url('/getTotal')}}",
	
    data:{'goods_id':goods_id},
	
	type : 'get',

	async:false,

	success:function(res){
	
	//console.log(res);

	$(_this).parents("tr").next().find("strong").text('¥'+res);
	
	}
	});
	}

	//总价格
    function getMoney(){
	
	var _box = $(".box:checked");

	//console.log(_box);return false;

	var goods_id = new Array;

	_box.each(function(index){
	
	//goods_id=goods_id+$(this).parents("tr").attr("goods_id")+',';

	goods_id.push($(this).parents("tr").attr("goods_id"));
	
	});
    //alert(goods_id);
	

    $.ajax({

    url:"{{url('/getMoney?goods_id=')}}"+goods_id,
	
    data:{},
	
	type : 'get',
	
	async:false,

	success:function(res){
	
	if(res == ''){
	
	res = '0';
	
	}
	//console.log(res);

    $("#money").find("strong").text('¥'+res);
	}
	});
	}

	//点击减号
	$(document).on("click",".less",function(){
	
	//alert('2');

	var _this = $(this);

	var buy_number = parseInt(_this.next("input").val());


	//alert(goods_number);

	if(buy_number>1){
	
     buy_number = buy_number-1;

	 _this.next("input").val(buy_number);

	 _this.css("background-color","purple");

	 _this.parents("tr").find(".box").prop("checked",true);

	 $(".＋").css("background-color","blue");

	  _this.parents("tr").css('background-color','gray');

	  changeNum(_this,buy_number);

      getTotal(_this);

	  getMoney();
	
	}
	}); 
	
//失去焦点
 $(document).on("blur",".buy_number",function(){
	
	//alert('3');
    
	var _this = $(this);

       var buy_number =  buy_number=_this.val();

	    $(".＋").css("background-color","blue");

		 $(".less").css("background-color","red");

       var goods_number = parseInt(_this.parents("tr").attr("goods_number"));


       if(parseInt(buy_number=='')||parseInt(buy_number)<1||(!/^\d+$/.test(buy_number))){

	    _this.parents("tr").css('background-color','gray');
	   _this.parents("tr").find(".box").prop("checked",true);
         _this.val(1);
	    }else if(parseInt(buy_number)>goods_number){

	      _this.parents("tr").css('background-color','gray');
	      _this.parents("tr").find(".box").prop("checked",true);
	      _this.val(goods_number);
	
	
	      }else{
      _this.parents("tr").css('background-color','gray');
	   _this.parents("tr").find(".box").prop("checked",true);
	    
	    _this.val(parseInt(buy_number));
	
	   }
	   buy_number = _this.val();
	   changeNum(_this,buy_number);
       getTotal(_this);
       getMoney();
	});


	//复选框
	$(document).on("click",".box",function(){
	
	//alert('4');

	var _this = $(this);

	var status = _this.prop('checked');

	if(status == true){
	
	_this.parents('tr').css('background-color','gray');
	
	}else{
	
	_this.parents('tr').css('background-color','');
	
	}

	getMoney();
	
	});

	//点击全选
	$(document).on("click","#all",function(){

	//alert('1234');
	//alert('5');
	 var status = $("#all").prop("checked");
     $(".box").prop("checked",status);
	 if(status == true){
	 
     $(".box").parents("tr").css('background-color','gray');
	 
	 }else{
	 
	 $(".box").parents("tr").css('background-color','');
	 
	 }
    
	getMoney();

	});
	
	//点击删除
	$(document).on("click",".del",function(){
	//alert('6');
	var _this = $(this);

	var goods_id = _this.parents("tr").attr("goods_id");

	var goods_number = _this.parents("tr").attr("goods_number");

	var is_del = confirm('确定要删除此条商品吗?');

	if(is_del == true){

	$.ajax({

    url:"{{url('/carDel')}}",
	
    data:{'goods_id':goods_id},
	
	type : 'get',

	dataType : 'json',

	success:function(res){
	
	//concole.log(res);

	if(res.error_no==0){
    
	
	_this.parents("tr").next().empty();
	_this.parents("tr").remove();
	
	

    getMoney();
	
	}else{
	
	alert(res.error_msg);
	
	}
	}
	
	});
	}
	});
	

	//删除选中的商品
	$(document).on("click","#delMany",function(){

	var _this = $(this);
	//alert('7');
	var _box = $(".box:checked");

	//console.log(_box);return false;

	var goods_id = "";

	_box.each(function(index){
	
	goods_id=goods_id+$(this).parents("tr").attr("goods_id")+',';


	
	});

	//console.log(goods_id);return false;

	 goods_id = goods_id.substring(0,goods_id.length-1);

	 //alert(goods_id);return;

	//console.log(goods_id);return false;
   var is_del = confirm('确定要删除此条商品吗?');

	if(is_del == true){

	 $.ajax({

    url:"{{url('/carDel?goods_id=')}}"+goods_id,
	
    data:{},
	
	type : 'get',

	dataType : 'json',

	success:function(res){
	
	//concole.log(res);

	if(res.error_no==0){
	
	_box.each(function(index){

    _box.parents("tr").next().empty();
	
	_box.parents("tr").remove();

	
	});
    getMoney();
	
	}else{
	
	alert(res.error_msg);
	
	}
	}
	});
	}
	});
    });
 </script>
 @endsection