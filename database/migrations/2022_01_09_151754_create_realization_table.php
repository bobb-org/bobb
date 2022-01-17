<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realization', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project')->constrained('contract');
            $table->date('startDate')->nullable();
            $table->date('plannedEndDate')->nullable();
            $table->foreignId('supervisor')->constrained('employee');
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
        Schema::dropIfExists('realization');
    }
}
