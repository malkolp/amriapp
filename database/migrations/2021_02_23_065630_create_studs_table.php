<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studs', function (Blueprint $table) {
            $table->id();
            $table->string('citizen_identity')->unique();
            $table->string('name');
            $table->enum('gender',['laki-laki','perempuan'])->default('laki-laki');
            $table->integer('day_birth')->default(1);
            $table->bigInteger('level_id')->unsigned();
            $table->bigInteger('archive_id')->unsigned();
            $table->string('month_birth')->default('januari');
            $table->integer('year_birth')->default(2004);
            $table->string('place_birth');
            $table->integer('grade');
            $table->string('group');
            $table->string('register_time');
            $table->text('address');
            $table->string('pic');
            $table->enum('religion',['islam','katolik','protestan','hindu','budha','kong hu chu','lain-lain'])->default('islam');

            $table->timestamps();
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('archive_id')->references('id')->on('archives')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studs');
    }
}
