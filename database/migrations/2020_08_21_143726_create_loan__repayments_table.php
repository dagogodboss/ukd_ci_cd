<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanRepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_repayments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('loan_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('transaction_type')->nullable();
            $table->integer('payment_bank')->nullable();
            $table->double('amount');
            $table->string('date_paid')->nullable();
            $table->text('notes')->nullable();
            $table->string('complete_payment_status')->nullable();
            $table->string('confirmation_status')->nullable();
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
        Schema::dropIfExists('loan__repayments');
    }
}
