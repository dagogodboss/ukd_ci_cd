<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('salary_type')->nullable();
            $table->float('basic_salary',11,2)->nullable();
            $table->float('accommodation_allowance',11,2)->nullable();
            $table->float('gross',11,2)->nullable();
            $table->float('percentage_to_achieved',11,2)->nullable();
            $table->float('telephone_allowance',11,2)->nullable();
            $table->float('leave_allowance',11,2)->nullable();
            $table->float('other_allowance',11,2)->nullable();
            $table->float('transportation_allowance',11,2)->nullable();
            $table->float('monthly_target',11,2)->nullable();
            $table->timestamp('smart_saver_date')->nullable();
            $table->string('account_number', 50)->nullable();
            $table->string('beneficiary_bank')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::dropIfExists('employee_salaries');
    }
}
