<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->charset('utf8mb4');
            $table->string('surname', 255)->charset('utf8mb4');
            $table->string('contact', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('PESEL', 11)->nullable();
            $table->string('seriesIdCard', 3)->nullable();
            $table->string('numberIdCard', 6)->nullable();
            $table->date('validityIdCard')->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->string('fatherName', 255)
                ->nullable()
                ->charset('utf8mb4');
            $table->string('adress', 255)
                ->charset('utf8mb4')
                ->nullable();
            $table->string('postCode', 255)
                ->charset('utf8mb4')
                ->nullable();
            $table->string('city', 255)
                ->charset('utf8mb4')
                ->nullable();
            $table->foreignId('company')->constrained('organization');
            $table->foreignId('position')->constrained('position');
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
        Schema::dropIfExists('employee');
    }
}
