<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardInstrumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_customer_repayment_card_instruments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('reference_code', 100);
            $table->string('authorization_code', 100);
            $table->string('card_type', 100);
            $table->string('last4', 100);
            $table->string('exp_month', 100);
            $table->string('exp_year', 100);
            $table->string('bin', 100);
            $table->string('bank', 100);
            $table->boolean('reusable', 100);
            $table->boolean('signature', 100);
            $table->boolean('channel', 100);
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_instruments');
    }
}
