<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchoolIdToAction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalog_action', function (Blueprint $table) {
            $table->foreignId('school_id')->after('course_id')->nullable();
            $table->foreign('school_id')
                    ->references('id')
                    ->on('catalog_school')
                    ->onDelete('cascade');
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
