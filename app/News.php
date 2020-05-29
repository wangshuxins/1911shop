<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

	protected  $primaryKey = 'nid';

	//protected $fillable = ['cate_name','pid','cate_show','cate_nav_show','cate_desc'];
    
	//protected $guarded = [];

	public $timestamps = false;
}
