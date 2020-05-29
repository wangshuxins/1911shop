<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bycar extends Model
{
    protected $table = 'bycar';

	protected  $primaryKey = 'car_id';

	//protected $fillable = ['cate_name','pid','cate_show','cate_nav_show','cate_desc'];
    
	//protected $guarded = [];

	public $timestamps = false;
}
