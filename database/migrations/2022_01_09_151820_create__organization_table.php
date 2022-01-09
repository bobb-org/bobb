<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_organization', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('contact', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('adress', 255)
                ->charset('utf8mb4')
                ->nullable();
            $table->string('postCode', 255)->nullable();
            $table->string('city', 255)
                ->charset('utf8mb4')
                ->nullable();
            $table->string('nip', 255);
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
        Schema::dropIfExists('_organization');
    }
}
