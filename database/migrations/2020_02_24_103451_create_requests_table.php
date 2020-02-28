<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('student_id')->index();
            $table->foreign('student_id')->references('id')
                ->on('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->tinyInteger('status')->default(0);
            $table->string('short_description');
            $table->text('description')->nullable();
            $table->unsignedInteger('subject_id');
            $table->foreign('subject_id')->references('id')
                ->on('subjects')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger('expect_fee');
            $table->float('number_of_hour')->default(2);
            $table->boolean('learning_method')->default(1);
            $table->tinyInteger('tutor_gender')->default(3);
            $table->tinyInteger('type_of_tutor')->default(3);
            $table->tinyInteger('number_of_student')->default(1);
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
        Schema::dropIfExists('requests');
    }
}
