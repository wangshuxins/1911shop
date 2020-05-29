<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('article_id');
            $table->string('article_title', 100);
            $table->integer('cate_id');
			$table->integer('order_article')->default(0)->comment('0:普通1:置顶');
			$table->integer('is_show')->default(0)->comment('0:显示1:不显示');
            $table->string('article_man', 100);
			$table->string('article_email', 100);
			$table->string('article_key', 100);
			$table->text('article_desc',255)->nullable($value=true);
		    $table->string('article_img', 100);
			$table->string('article_time', 100);
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
        Schema::dropIfExists('article');
    }
}
