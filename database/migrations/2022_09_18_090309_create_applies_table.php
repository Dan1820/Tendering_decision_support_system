<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applies', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->double('finance');
            $table->integer('cost');
            $table->string('licence');
            $table->string('registration_no');
            $table->string('date_registered');
            $table->string('business_address');
            $table->integer('portfolio');
            $table->string('tender_id');
            $table->string('sms')->default('not_sent');
            $table->string('user_id');

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
        Schema::dropIfExists('applies');
    }
};
