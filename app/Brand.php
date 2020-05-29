<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';

	protected  $primaryKey = 'brand_id';

	//protected $fillable = ['brand_name','brand_url','brand_logo','brand_desc'];
    
	protected $guarded = [];

	public $timestamps = false;

	public static function getBrandIndex($pageSize,$where){
	
	return self::where($where)->orderBy('brand_id','desc')->paginate($pageSize);
	
	}
}
