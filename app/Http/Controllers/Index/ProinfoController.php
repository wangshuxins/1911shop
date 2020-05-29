<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shop_goods;
use App\Bycar;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class ProinfoController extends Controller
{
    //首页
	public function proinfo($id){
    
	#############################
     
   // $goodx = cache('goodx_'.$id);

    $goodx = Redis::get('goodx_'.$id);

    //dump($goodx);

    if(!$goodx){
	
	//echo 'db';

	$goodx = Shop_goods::find($id);

	//cache(['goodx_'.$id=>$goodx],60);

	$goodx = serialize($goodx);

	Redis::setex('goodx_'.$id,1,$goodx);

	
	}

	$goodx = unserialize($goodx);

	if($goodx->is_show!==1){
	
	return redirect('/')->with('msg','此商品已下架！');
	
	}

    
    #############################

    //$visit = Cache::add('visit_'.$id,1)?1:Cache::increment('visit_'.$id);

	$visit = Redis::setnx('visit_'.$id,1)?:Redis::incr('visit_'.$id);
  
    #############################

	
	//辅助函数

    // $goods_id = cache('goods_'.$id);

	//$goods_id = Cache::get('goods_'.$id);

	//redis
   
 	$goods_id = Redis::get('goods_'.$id);

    // dump($goods_id);

    if(!$goods_id){
    
	//echo 'db';

	$where = [
	
	['is_show','=',1],
	['goods_id','=',$id]
	
	];

    $goods_id = Shop_goods::where($where)->get();
    
	//辅助函数
    //cache(['goods_'.$id=>$goods_id],60);

	//Cache::put('goods_'.$id,$goods_id,60);

    $goods_id = serialize($goods_id);

	Redis::setex('goods_'.$id,60,$goods_id);

    }

    $goods_id = unserialize($goods_id);

    return view("index.proinfo",['goods_id'=>$goods_id,'visit'=>$visit]);

	}

    //加入购物车
	public function buycar(){

	$user = session('requister');

    if(!$user){
	
	echo json_encode(['error_no'=>6,'error_msg'=>'未登录']);die;
	
	}

     $goods_id = Request()->input('goods_id');


	 //echo $goods_id;exit;

	 $buy_number = Request()->input('buy_number');

     //echo $buy_number;exit;
	
     $rid = session('requister')->rid;
	 
	  //dd($rid);

      $Bycar = new Bycar();

      $where = [
	
        ['rid','=',$rid],

        ['goods_id','=',$goods_id],


      ];


      $ret = $Bycar::where($where)->first();

      //dd($ret);

      if(empty($ret)){

      $result = $this->checkGoodsNum($buy_number,$goods_id);

      //dd($result);

      if(empty($result)){

         error("购买数量超过库存量");

      }

     $wheres = [
		 
	    ['is_show','=',1],
	 
	 ];


	 $goods = Shop_goods::where($wheres)->find($goods_id);


     $arr = ['goods_id'=>$goods_id,'buy_number'=>$buy_number,'rid'=>$rid,'goods_price'=>$goods->goods_price,'buy_time'=>time()];

     $res = $Bycar::insert($arr);

     if($res){
 
     success('');

     }else{

       error('加入购物车失败');

     }
     }else{

     $result = $this->checkGoodsNum($buy_number,$goods_id,$ret['buy_number']);

     //dump($result);exit;

      if(empty($result)){

        error("购买数量超过库存量");

      }

      $buy_number = $buy_number+$ret['buy_number'];

      $arr = ['goods_id'=>$goods_id,'buy_number'=>$buy_number,'rid'=>$rid,'buy_time'=>time()];

      $res = $Bycar::where($where)->update(['buy_number'=>$buy_number,'buy_time'=>time()]);

      if($res){
 
           success('');

         }else{

           error('加入购物车失败');

        }
	 }
   }

	public function car(){

	$rid = session('requister')->rid;

	$where = [
	
     ['rid','=',$rid],
     

	

  ];

	
	
	$sum = Bycar::where($where)->sum('buy_number');

	$sum = intval($sum);

	//dd($sum);

	//dd($bycar);

	$wheres = [
	
     ['rid','=',$rid],
     ['is_show','=',1]

	

    ];

	//第一种
		$bycar = Bycar::where($wheres)->leftjoin('shop_goods','bycar.goods_id','=','shop_goods.goods_id')->get();
	return view('index.car',['bycar'=>$bycar,'sum'=>$sum]);


	
	
	}

	//方法
	public function checkGoodsNum($buy_number,$goods_id,$already_num=0){


                $shop_goods = new Shop_goods();

                $goods_number = $shop_goods::where('goods_id','=',$goods_id)->value("goods_number");

                 
                if(($buy_number+$already_num)>$goods_number){


                return false;


                   }else{

               return true;

              }
            }

            //商品总价
			public function changeNumber(){

               $goods_id = Request()->input('goods_id');

	            //echo $goods_id;exit;

	           $buy_number = Request()->input('buy_number');


              

               $rid = session('requister')->rid;

               //echo '购买数量:'.$buy_number.'商品ID:'.$goods_id;exit;

               $where = [
                 ['rid','=',$rid],
                 ['goods_id','=',$goods_id],
                ];

                $res = Bycar::where($where)->update(['buy_number'=>$buy_number]);

                if($res){

                success("修改成功");

                }else{

                error("");

                }
               }

			   public function getTotal(){

               $goods_id = Request()->input('goods_id');


               //echo $goods_id;exit;

               $rid = session('requister')->rid;

                $where = [
	

                    ['shop_goods.goods_id','=',$goods_id],

                         ['rid','=',$rid],


                    ]; 


               $car = Bycar::select('shop_goods.*','shop_goods.goods_id','shop_goods.goods_price','buy_number')
	             ->leftjoin("shop_goods",'shop_goods.goods_id','=','bycar.goods_id')
	             ->where($where)
	             ->first();
                 
                  
                 echo $sj = $car['buy_number']*$car['goods_price'];exit;


                 }
                 
				 //总计
                 public function getMoney(){

                  $goods_id = Request()->input('goods_id');

				  $goods_id = explode(",",$goods_id);


				  $rid = session('requister')->rid;

                   
				  foreach($goods_id as $v){
					   
				  $bycar = Bycar::where('rid','=',$rid)->whereIn('goods_id',["$v"])->sum('goods_price');


				  }

				  echo $bycar;

                }

                //删除 批量删除
	            public function carDel(){

                  $goods_id = Request()->input('goods_id');

	              $str = explode(",",$goods_id);

	              //var_dump($str);die;

	              $rid = session('requister')->rid;

	

	              foreach($str as $v){

		          $where = [
	
	                  ['rid','=',$rid],

	                  ['goods_id',"=","$v"]
	
	               ];


                    $ret = Bycar::where($where)->delete();

                   }

                   //dump(db::getLastSql());exit;

                    if($ret!==false){

                        success('删除成功');

                       }else{

                        error("删除失败");

                    }
                 }

          }

