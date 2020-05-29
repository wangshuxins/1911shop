<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shop_goods;
use App\Shop_category;
use App\Admin;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{

     public function index(){
     
         //--redis
		 $slice = Redis::get('slice');

		 $category = Redis::get('category');

		 $shop = Redis::get('shop');

		 $newshop = Redis::get('newshop');


	    //辅助函数---memcache
		//$slice = Cache('slice');

		//$category = Cache('category');

		//$shop = Cache('shop');

		//$newshop = Cache('newshop');

		//$slice = Cache::get('slice');

		//$category = Cache::get('category');

		//$shop = Cache::get('shop');

		//$newshop = Cache::get('newshop');

        //dump($slice);
        
		if(!$slice){
       
		//echo "db";
		 //首页幻灯片
	     $slice = Shop_goods::getSliceData();

		 //辅助函数
		 //cache(['slice'=>$slice],60);

		//Cache::put('slice',$slice,60);
         $slice = serialize($slice);
		 Redis::setex('slice',60,$slice);

		}
		$slice = unserialize($slice);

		 
		
         //dump($category);

		if(!$category){
		
		//echo "db";
     
		$category = Shop_category::getTopData();
      

         //redis
         $category = serialize($category);
		 Redis::setex('category',60,$category);
		  

		//辅助函数
		// cache(['category'=>$category],60);

		//Cache::put('category',$category,60);

        }
		$category = unserialize($category);

		//dump($shop);

		if(!$shop){
		
		//echo "db";

		$shop = Shop_goods::where('is_show',1)->orderBy('is_new','desc')->take(8)->get();
         
		 //辅助函数
		 //cache(['shop'=>$shop],60);

		//Cache::put('shop',$shop,60);
		 $shop = serialize($shop);
		 Redis::setex('shop',60,$shop);

		}
       $shop = unserialize($shop);
		//dump($newshop);

		if(!$newshop){
		
		//echo "db";
        
		$newshop = Shop_goods::where('is_show',1)->orderBy('is_new','desc')->take(3)->get();
         
		 //辅助函数
		 //cache(['newshop'=>$newshop],60);
		//Cache::put('newshop',$newshop,60);

		 $newshop = serialize($newshop);
		 Redis::setex('newshop',60,$newshop);
		
		}

		 $newshop = unserialize($newshop);

	    return view('index.index',compact('slice','category','shop','newshop'));
       
	     
	
	 }
}
