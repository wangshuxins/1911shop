<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop_goods extends Model
{
    protected $table = 'shop_goods';

	protected  $primaryKey = 'goods_id';

	//protected $fillable = ['cate_name','pid','cate_show','cate_nav_show','cate_desc'];
    
	//protected $guarded = [];

	public $timestamps = false;
	
    public static function getGoodsIndex($pageSize){
	
	return self::orderBy('goods_id','desc')->paginate($pageSize);
	
	}
	public static function getSliceData(){
	$where['is_slice']=1;
	$where['is_show']=1;
	return self::select('goods_id','goods_img')->where($where)->orderBy('is_new','desc')->take(5)->get();
	
	} 
}
