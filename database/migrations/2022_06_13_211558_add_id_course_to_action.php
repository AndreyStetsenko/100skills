<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdCourseToAction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalog_action', function (Blueprint $table) {
            $table->foreignId('course_id')->after('body_long')->nullable();
            $table->foreign('course_id')
                    ->references('id')
                    ->on('catalog_course')
                    ->onDelete('cascade');

            $table->string('new_price')->after('body_long')->nullable();

            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalog_action', function (Blueprint $table) {
            //
        });
    }
}
