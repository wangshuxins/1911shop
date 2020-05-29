<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articleclass extends Model
{
    protected $table = 'articleclass';

	 protected  $primaryKey = 'cate_id';

	 public $timestamps = false;
}
