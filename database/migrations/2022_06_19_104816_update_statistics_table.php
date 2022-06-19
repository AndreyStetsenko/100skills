<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('statistics', function (Blueprint $table) {
            $table->dropColumn(['link', 'slug']);
            $table->foreignId('school_id')->before('action')->nullable();
            $table->foreign('school_id')
                    ->references('id')
                    ->on('catalog_school')
                    ->onDelete('cascade');
            $table->foreignId('course_id')->before('school_id')->nullable();
            $table->foreign('course_id')
                    ->references('id')
                    ->on('catalog_course')
                    ->onDelete('cascade');
            $table->string('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
