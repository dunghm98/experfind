<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mon')->default('');
            $table->string('tue')->default('');
            $table->string('wed')->default('');
            $table->string('thur')->default('');
            $table->string('fri')->default('');
            $table->string('sat')->default('');
            $table->string('sun')->default('');
            $table->unsignedBigInteger('request_id')->nullable();
            $table->foreign('request_id')->references('id')
                ->on('requests')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger('tutor_id')->nullable();
            $table->foreign('tutor_id')->references('id')
                ->on('tutors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('schedules');
    }
}
