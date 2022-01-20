<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->charset('utf8mb4');
            $table->string('surname', 255)->charset('utf8mb4');
            $table->string('contact', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('pesel', 11)->nullable();
            $table->string('series_id_card', 3)->nullable();
            $table->string('number_id_card', 6)->nullable();
            $table->date('validity_id_card')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('father_name', 255)
                ->nullable()
                ->charset('utf8mb4');
            $table->string('adress', 255)
                ->charset('utf8mb4')
                ->nullable();
            $table->string('post_code', 255)
                ->charset('utf8mb4')
                ->nullable();
            $table->string('city', 255)
                ->charset('utf8mb4')
                ->nullable();
            $table->foreignId('organization_id')->constrained('organizations');
            $table->foreignId('position_id')->constrained('positions');
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
        Schema::dropIfExists('employees');
    }
}
