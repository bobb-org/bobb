<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAutdeskForgeBucketIdToRealization extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('realizations', function (Blueprint $table) {
			$table->text('autodesk_forge_bucket_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('realizations', function (Blueprint $table) {
			$table->dropColumn('autodesk_forge_bucket_id');
        });
    }
}
