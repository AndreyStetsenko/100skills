<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        # таблица содержащая информацию о странице
        // Schema::create("page_contact", function (Blueprint $table) {
        //     $table->id();
            
        //     $table->string('meta_title', 255)->nullable(); # meta: title 
        //     $table->string('meta_description', 255)->nullable(); # meta: description 
        //     $table->string('meta_keywords', 255)->nullable(); # meta: keywords 
        //     $table->string('meta_canonical', 255)->nullable(); # ссылка на canonical страницу 

        //     $table->timestamps();
        //     $table->softDeletes();
        // });

        # таблица содержащая информацию о каталоге на странице
        Schema::create("catalog_contact", function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable(); # наименование 
            $table->string('slug', 255)->nullable(); # slug

            $table->string("value", 255)->nullable(); # значение
            $table->string("href", 255)->nullable(); # значение href

            $table->integer('is_visible')->nullable(); # видимость
            $table->integer('sort')->nullable(); # сортировка

            $table->timestamps();
            $table->softDeletes();
        }); # основной объект

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        # сначала дропаем таблицы по foreign_id, потом основную
        
        // Schema::dropIfExists('page_contact');
        Schema::dropIfExists('catalog_contact');
        
    }
}
