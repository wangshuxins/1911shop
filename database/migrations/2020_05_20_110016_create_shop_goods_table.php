<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_goods', function (Blueprint $table) {
			$table->increments('goods_id');
            $table->string('goods_sn', 100);
			$table->string('goods_name', 100);
			$table->decimal('goods_price', 5, 2);
			$table->text('goods_desc',255)->nullable($value=true);
			$table->integer('goods_number');
			$table->string('goods_img');
			$table->string('goods_imgs');
			$table->integer('is_show')->default(0)->comment('0为√,1为×');
			$table->integer('is_new')->default(0)->comment('0为√,1为×');
			$table->integer('is_best')->default(0)->comment('0为√,1为×');
			$table->integer('brand_id')->default(0)->comment('0为√,1为×');
            $table->integer('cate_id')->default(0)->comment('0为√,1为×');
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
        Schema::dropIfExists('shop_goods');
    }
}
