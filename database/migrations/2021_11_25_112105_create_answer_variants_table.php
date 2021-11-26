<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('survey_id');
            $table->integer('order_number');
            $table->string('answer_variant');
            $table->timestamps();

            $table->foreign('survey_id')->references('id')->on('surveys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_variants');
    }
}
