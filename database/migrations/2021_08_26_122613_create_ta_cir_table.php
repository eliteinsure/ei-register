<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaCirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ta_cir', function (Blueprint $table) {
            $table->increments('report_number');
            $table->string('send_date', 50)->nullable();
            $table->string('due_date', 50)->nullable();
            $table->longText('investigation_information')->nullable();
            $table->integer('adviser_id')->nullable();
            $table->longText('rep_response')->nullable();
            $table->longText('adv_response')->nullable();
            $table->longText('rep_action')->nullable();
            $table->integer('to_address')->nullable()->default(0)->comment('0 - Not answered 1 - Answered');
            $table->integer('link_status')->nullable()->default(1)->comment('0 - Expired 1 - Active');
            $table->string('link_password', 50)->nullable();
            $table->integer('representative_id')->nullable();
            $table->longText('adv_signature')->nullable();
            $table->longText('rep_signature')->nullable();
            $table->integer('satisfactory')->nullable();
            $table->longText('if_not')->nullable();
            $table->string('finalisation')->nullable();
            $table->date('adv_response_date')->nullable();
            $table->date('rep_response_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ta_cir', function (Blueprint $table) {



















        });
    }
}
