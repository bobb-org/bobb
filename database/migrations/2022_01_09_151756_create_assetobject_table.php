<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetObjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assetobject', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset')->constrained('asset');
            $table->string('name');
            $table->json('properties')->nullable();
            $table->json('images')->nullable();
            $table->json('schemes')->nullable();
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
        Schema::dropIfExists('assetobject');
    }
}
