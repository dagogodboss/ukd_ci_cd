<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->boolean('customer_request')->nullable()->default(false);
            $table->integer('loan_officer_id')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->integer('product_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->date('release_date')->nullable();
            $table->date('maturity_date')->nullable();
            $table->unsignedBigInteger('customer_verification_id');
            $table->date('interest_start_date')->nullable();
            $table->date('first_payment_date')->nullable();
            $table->integer('loan_disbursed_by_id')->nullable();
            $table->double('principal');
            $table->double('disbursed_amount')->nullable();
            $table->enum('interest_method', [
                'flat_rate',
               'installments',
                'interest_only',
                'compound_interest',
            ])->default('flat_rate');
            $table->double('interest_rate')->nullable();
            $table->enum('repayment_method', array(
                'daily',
                'weekly',
                'monthly',
                'bi_monthly',
                'quarterly',
                'semi_annually',
                'annually'
            ))->default('monthly');
            $table->text('files')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', array(
                'open',
                'fully_paid',
                'defaulted',
                'restructured',
                'processing'
            ))->default('open');
            $table->string('repayment_instrument')->nullable();
            $table->string('loan_duration')->nullable();
            $table->string('loan_duration_lenght')->nullable();
            $table->text('loan_purpose')->nullable();

            $table->string('confirmation_status')->nullable();
            $table->string('rejection_status')->nullable();
            $table->string('decline')->nullable();
            $table->text('decline_reason')->nullable();
            $table->float('special_interest')->nullable();
            $table->double('balance')->nullable();
            $table->string('disburesment_bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('acount_number')->nullable();
            
            $table->timestamps();

            $table->foreign('customer_id')
            ->references('id')
            ->on('customers')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('customer_verification_id')
            ->references('id')
            ->on('customer_verifications')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
