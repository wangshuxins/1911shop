<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop_category extends Model
{
    protected $table = 'shop_category';

	protected  $primaryKey = 'cate_id';

	//protected $fillable = ['cate_name','pid','cate_show','cate_nav_show','cate_desc'];
    
	//protected $guarded = [];

	public $timestamps = false;

	public static function getTopData(){
	
	return self::select('cate_id','cate_name')->where(['pid'=>0,'cate_nav_show'=>1,'cate_show'=>1])->orderBy('cate_id','desc')->take(4)->get();
	
	}
}
