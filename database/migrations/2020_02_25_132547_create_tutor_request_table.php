<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_request', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tutor_id')->index();
            $table->unsignedBigInteger('request_id')->index();
            $table->foreign('tutor_id')->references('id')
                ->on('tutors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('request_id')->references('id')
                ->on('requests')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->tinyInteger('status')->default(0);
            $table->boolean('sender');
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
        Schema::dropIfExists('tutor_request');
    }
}
