<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parets', function (Blueprint $table) {
            $table->id();
            $table->string('citizen_identity')->unique();
            $table->string('name');
            $table->enum('gender',['laki-laki','perempuan'])->default('laki-laki');
            $table->integer('day_birth')->default(1);
            $table->string('month_birth')->default('januari');
            $table->integer('year_birth')->default(1989);
            $table->string('place_birth');
            $table->text('address');
            $table->enum('religion',['islam','katolik','protestan','hindu','budha','kong hu chu','lain-lain'])->default('islam');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('occupation');
            $table->string('salary');
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
        Schema::dropIfExists('parets');
    }
}
