<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->charset('utf8mb4');
            $table->string('post_code', 255)->charset('utf8mb4');
            $table->string('city', 255)->charset('utf8mb4');
            $table->string('adress', 255)->charset('utf8mb4');
            $table->foreignId('general_contractor')->constrained('organizations');
            $table->foreignId('contractor')->constrained('organizations');
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
        Schema::dropIfExists('contracts');
    }
}
