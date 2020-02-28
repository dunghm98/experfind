<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tutor_id')->index();
            $table->unsignedInteger('subject_id')->index();

            $table->foreign('tutor_id')->references('id')
                ->on('tutors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('subject_id')->references('id')
                ->on('subjects')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutor_subject');
    }
}
