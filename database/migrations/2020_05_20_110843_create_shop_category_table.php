<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_category', function (Blueprint $table) {
            $table->increments('cate_id');
			$table->string('cate_name', 100);
			$table->integer('pid');
			$table->integer('cate_show');
			$table->integer('cate_nav_show');
			$table->text('cate_desc')->nullable($value=true);
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_category');
    }
}
