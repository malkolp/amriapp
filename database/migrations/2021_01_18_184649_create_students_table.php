<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('citizen_identity')->unique();
            $table->string('name');
            $table->enum('gender',['laki-laki','perempuan'])->default('laki-laki');
            $table->integer('day_birth')->default(1);
            $table->string('month_birth')->default('januari');
            $table->integer('year_birth')->default(2004);
            $table->string('place_birth');
            $table->text('address');
            $table->string('pic');
            $table->enum('religion',['islam','katolik','protestan','hindu','budha','kong hu chu','lain-lain'])->default('islam');
            $table->bigInteger('group_id')->unsigned();
            $table->bigInteger('grade_id')->unsigned();
            $table->bigInteger('level_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
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
        Schema::dropIfExists('students');
    }
}
