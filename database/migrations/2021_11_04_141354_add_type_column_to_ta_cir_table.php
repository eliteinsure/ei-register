<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnToTaCirTable extends Migration
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
            $table->date('date_created')->nullable()->useCurrent();
            $table->integer('type')->nullable()->default(1);
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
            $table->dropColumn(['status', 'access_status', 'date_created', 'type']);
        });
    }
}
