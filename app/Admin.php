<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
     protected $table = 'admin';

	 protected  $primaryKey = 'admin_id';

	 public $timestamps = false;

     public static function getBrandIndex($pageSize){
	
	return self::orderBy('admin_id','desc')->paginate($pageSize);
	
	}
	
}
