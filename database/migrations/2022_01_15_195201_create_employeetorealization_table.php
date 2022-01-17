<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeetorealizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeetorealization', function (Blueprint $table) {
            $table->id();
            $table->foreignId('realizationId')->constrained('realization');
            $table->foreignId('employeeId')->constrained('employee');
            $table->timestamps();
            $table->foreignId('introducer')->constrained('employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employeetorealization');
    }
}
