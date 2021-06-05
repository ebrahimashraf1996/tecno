<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmallSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('small_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_ar');
            $table->string('title_en');
            $table->mediumText('small_p_ar');
            $table->mediumText('small_p_en');
            $table->string('icon');
            $table->boolean('is_active')->default(1);
            $table->integer('large_section_id')->unsigned()->nullable();
            $table->foreign('large_section_id')->references('id')->on('large_sections')->onDelete('cascade');
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
        Schema::dropIfExists('small_sections');
    }
}
