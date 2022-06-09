<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create("action_category", function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->string('slug', 255)->nullable();

            $table->integer('parent_id'); # родительский элемент этой же таблицы

            $table->integer('is_visible')->nullable(); # видимость
            $table->integer('sort')->nullable(); # сортировка

            $table->timestamps();
            $table->softDeletes();
        }); # категория

        # основная таблица содержащая информацию о каталоге
        Schema::create("catalog_action", function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable(); # наименование 
            $table->string('slug', 255)->nullable(); # slug

            $table->foreignId('category_id')->nullable();
            $table->foreign('category_id')
                    ->references('id')
                    ->on('catalog_action')
                    ->onDelete('cascade'); # категория

            $table->string("body_short", 255)->nullable(); # краткое описание, подзаголовок
            $table->text("body_long")->nullable(); # полное описание

            $table->string("video_link", 255)->nullable(); # ссылка на видео

            # $table->string("author", 255)->nullable();
            # $table->string("duration", 255)->nullable();
            # $table->integer("price")->nullable();

            $table->foreignId('gallery_id')->nullable();
            $table->foreign('gallery_id')
                    ->references('id')
                    ->on('gallery')
                    ->onDelete('cascade'); # ссылка на изображение

            $table->foreignId('video_id')->nullable();
            $table->foreign('video_id')
                    ->references('id')
                    ->on('video')
                    ->onDelete('cascade'); # ссылка на видео

            $table->string('meta_title', 255)->nullable(); # meta: title 
            $table->string('meta_description', 255)->nullable(); # meta: description 
            $table->string('meta_keywords', 255)->nullable(); # meta: keywords 
            $table->string('meta_canonical', 255)->nullable(); # ссылка на canonical страницу 

            $table->integer('is_active_gallery')->nullable(); # активность галерею
            $table->integer('is_active_video')->nullable(); # активность галерею
            $table->integer('is_visible')->nullable(); # видимость
            $table->integer('sort')->nullable(); # сортировка

            $table->timestamps();
            $table->softDeletes();
        }); # основной объект

        # таблица содержит отношения
        Schema::create('gallery_action', function (Blueprint $table) {
            $table->unsignedBigInteger('gallery_id');
            $table->unsignedBigInteger('item_id');
        
            $table->foreign('gallery_id')->references('id')->on('gallery')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('catalog_action')->onDelete('cascade');
        
            $table->primary(['gallery_id', 'item_id']);

        }); 
        # таблица содержит отношения
        Schema::create('video_action', function (Blueprint $table) {
            $table->unsignedBigInteger('video_id');
            $table->unsignedBigInteger('item_id');
        
            $table->foreign('video_id')->references('id')->on('video')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('catalog_action')->onDelete('cascade');
        
            $table->primary(['video_id', 'item_id']);

        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        # сначала дропаем таблицы по foreign_id, потом основную
        
        Schema::dropIfExists('blog_category');
        Schema::dropIfExists('catalog_action');
        Schema::dropIfExists('gallery_blog');
        Schema::dropIfExists('video_blog');
        
    }
}
