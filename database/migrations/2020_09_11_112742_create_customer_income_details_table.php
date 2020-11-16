<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerIncomeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_income_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->float('income', 11, 2)->default(0.00);
            $table->enum('employment_status', ['employed','self-employed','student','retired'])->nullable();
            
            $table->text('business_name')->nullable();
            $table->string('business_state')->nullable();
            $table->string('business_city')->nullable();
            $table->string('business_lga')->nullable();

            $table->string('business_address')->nullable();
            $table->string('rc_bn')->nullable();
            $table->string('beneficiary_bank')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('monthly_turn_over')->nullable();
            $table->string('monthly_profit')->nullable();
            $table->string('date_of_inc_reg')->nullable();

            $table->string('employers_name')->nullable();
            $table->string('joined_date')->nullable();
            $table->string('monthly_gross_salary')->nullable();
            $table->string('monthly_net_pay')->nullable();
            $table->string('salary_account_number')->nullable();
            $table->string('salary_bank_name')->nullable();
            $table->string('salary_account_name')->nullable();
            $table->string('salary_pay_day')->nullable();
            $table->string('employer_phone_number')->nullable();
            $table->string('employer_email')->nullable();

            $table->string('name_of_institution_retired_from')->nullable();
            $table->string('retired_start_date')->nullable();
            $table->string('retired_end_date')->nullable();
            $table->string('pension_paying_institute')->nullable();
            $table->string('pension_number')->nullable();
            $table->string('monnthly_pension_amount')->nullable();
            $table->string('pension_bank')->nullable();


            $table->string('school_name')->nullable();
            $table->string('school_address')->nullable();
            $table->string('current_level')->nullable();
            $table->string('name_of_department')->nullable();
            $table->string('parent_full_name')->nullable();
            $table->string('parent_address')->nullable();

            $table->string('id_card')->nullable();
            $table->string('bank_statement')->nullable();
            $table->string('utility_bill')->nullable();
            $table->string('other_files')->nullable();
            

            $table->integer('created_by');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('customer_income_details');
    }
}
