<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create("catalog_course_category", function (Blueprint $table) {
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
        Schema::create("catalog_course", function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable(); # наименование 
            $table->string('slug', 255)->unique()->nullable(); # slug

            $table->foreignId('category_id')->nullable();
            $table->foreign('category_id')
                    ->references('id')
                    ->on('catalog_course_category')
                    ->onDelete('cascade'); # категория

            $table->foreignId('school_id')->nullable();
            $table->foreign('school_id')
                    ->references('id')
                    ->on('catalog_school')
                    ->onDelete('cascade');

            $table->string("body_short", 255)->nullable(); # краткое описание
            $table->text("body_long")->nullable(); # полное описание
            $table->text('body_goals')->nullable(); # кастомный текст: чему вы научитесь
            $table->text('body_course')->nullable(); # кастомный текст: описание курса

            $table->string("author", 255)->nullable();
            $table->string("duration", 255)->nullable();
            $table->integer("price")->nullable();
            $table->string("link", 255)->nullable();

            $table->foreignId('gallery_id')->nullable();
            $table->foreign('gallery_id')
                    ->references('id')
                    ->on('gallery')
                    ->onDelete('cascade'); # ссылка на изображение

            $table->string('meta_title', 255)->nullable(); # meta: title 
            $table->string('meta_description', 255)->nullable(); # meta: description 
            $table->string('meta_keywords', 255)->nullable(); # meta: keywords 
            $table->string('meta_canonical', 255)->nullable(); # ссылка на canonical страницу 

            $table->integer('is_action')->nullable();
            $table->integer('is_recomended')->nullable();
            $table->integer('is_jobable')->nullable();
            $table->integer('is_certificate')->nullable();
            $table->integer('is_proffession')->nullable();
            $table->integer('is_online')->nullable(); # курс онлайн/оффлайн
            $table->integer('is_popular')->nullable(); # популярный курс
            $table->integer('is_active_gallery')->nullable(); # показывать ли галерею
            $table->integer('is_visible')->nullable(); # видимость
            $table->integer('sort')->nullable(); # сортировка

            $table->timestamps();
            $table->softDeletes();
        }); # основной объект

        # таблица содержит отношения между directions и transport в случае когда отношения belongsToMany 
        Schema::create('catalog_course_similar', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('similar_id');
        
            $table->foreign('course_id')->references('id')->on('catalog_course')->onDelete('cascade');
            $table->foreign('similar_id')->references('id')->on('catalog_course')->onDelete('cascade');
        
            $table->primary(['course_id','similar_id']);
        }); 

        # таблица содержит отношения между directions и transport в случае когда отношения belongsToMany 
        Schema::create('gallery_course', function (Blueprint $table) {
            $table->unsignedBigInteger('gallery_id');
            $table->unsignedBigInteger('item_id');
        
            $table->foreign('gallery_id')->references('id')->on('gallery')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('catalog_course')->onDelete('cascade');
        
            $table->primary(['gallery_id', 'item_id']);
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
        
        Schema::dropIfExists('catalog_course_category');
        Schema::dropIfExists('catalog_course');
        Schema::dropIfExists('catalog_course_similar');
        Schema::dropIfExists('gallery_course');
        
    }
}
