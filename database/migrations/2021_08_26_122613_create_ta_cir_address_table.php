<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaCirAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ta_cir_address', function (Blueprint $table) {
            $table->integer('id_question', true);
            $table->integer('report_number')->nullable();
            $table->string('issue_address')->nullable();
            $table->string('adviser_answer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ta_cir_address', function (Blueprint $table) {




        });
    }
}
