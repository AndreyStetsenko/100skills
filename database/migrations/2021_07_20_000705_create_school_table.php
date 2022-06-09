<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        # основная таблица содержащая информацию о каталоге
        Schema::create("catalog_school", function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable(); # наименование 
            $table->string('slug', 255)->nullable(); # slug

            $table->text("body_short")->nullable();
            $table->string("phone", 255)->nullable();
            $table->string("email", 255)->nullable();

            $table->string("adress", 255)->nullable();
            $table->float("latitude", 11, 6)->nullable();
            $table->float("longitude", 11, 6)->nullable();

            $table->foreignId('tarif_id')->nullable();
            $table->foreign('tarif_id')
                    ->references('id')
                    ->on('catalog_tarif')
                    ->onDelete('cascade');

            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->string('meta_title', 255)->nullable(); # meta: title 
            $table->string('meta_description', 255)->nullable(); # meta: description 
            $table->string('meta_keywords', 255)->nullable(); # meta: keywords 
            $table->string('meta_canonical', 255)->nullable(); # ссылка на canonical страницу 

            $table->integer('is_active_gallery')->nullable();
            $table->integer('is_visible')->nullable();
            $table->integer('sort')->nullable(); # сортировка

            $table->timestamps();
            $table->softDeletes();
        }); # основной объект

        # таблица содержит отношения
        Schema::create('gallery_school', function (Blueprint $table) {
            $table->unsignedBigInteger('gallery_id');
            $table->unsignedBigInteger('item_id');
        
            $table->foreign('gallery_id')->references('id')->on('gallery')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('catalog_school')->onDelete('cascade');
        
            $table->primary(['gallery_id', 'item_id']);

        });
        # таблица содержит отношения
        Schema::create('school_action', function (Blueprint $table) {
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('item_id');
        
            $table->foreign('school_id')->references('id')->on('catalog_school')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('catalog_action')->onDelete('cascade');
        
            $table->primary(['school_id', 'item_id']);

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
        
        Schema::dropIfExists('catalog_school');
        Schema::dropIfExists('gallery_school');
        Schema::dropIfExists('school_action');
        
    }
}
