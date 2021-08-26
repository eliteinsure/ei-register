<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaCirIdentifiedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('cir')->create('ta_cir_identified', function (Blueprint $table) {
            $table->integer('report_number')->nullable();
            $table->string('issue_identified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('cir')->drop('ta_cir_identified', function (Blueprint $table) {
            
            
        });
    }
}
