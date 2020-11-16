<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->float('minimum_principal', 11, 4)->nullable();
            $table->float('maximum_principal', 11, 4)->nullable();
            $table->enum('interest_method', array(
                'flat_rate',
                'installments',
                'interest_only',
                'compound_interest'
            ))->default('flat_rate');
            $table->float('interest_rate', 11, 4)->nullable();
            $table->string('loan_duration');
            $table->tinyInteger('loan_duration_length')->default(1)->nullable();
            $table->enum('repayment_method', array(
                'daily',
                'weekly',
                'monthly',
                'bi_monthly',
                'quarterly',
                'semi_annually',
                'annually'
            ))->default('monthly');
            $table->tinyInteger('enable_late_repayment_penalty')->default(0)->nullable();
            $table->tinyInteger('enable_after_maturity_date_penalty')->default(0)->nullable();
            $table->float('late_repayment_penalty_amount', 11, 4)->nullable();
            $table->float('after_maturity_date_penalty_amount', 11, 4)->nullable();
            $table->boolean('status')->nullable()->default(false);
            $table->float('early_repayment_charge', 11, 4)->nullable();
            $table->float('insurance_charge', 11, 4)->nullable();
            $table->float('processing_charge', 11, 4)->nullable();
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
        Schema::dropIfExists('products');
    }
}
