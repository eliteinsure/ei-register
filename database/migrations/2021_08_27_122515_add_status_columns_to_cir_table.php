<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnsToCirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ta_cir', function (Blueprint $table) {
            $table->integer('status')->nullable()->default(0);
            $table->integer('access_status')->nullable()->default(0);
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ta_cir', function (Blueprint $table) {
            $table->dropColumn(['status', 'access_status']);
        });
    }
}
