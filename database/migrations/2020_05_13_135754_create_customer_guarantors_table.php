<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerGuarantorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_guarantors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('other_name')->nullable();
            $table->string('relationship')->nullable();
            $table->string('email');
            $table->string('phone_number');
            $table->integer('age');
            $table->double('monthly_income')->nullable();
            $table->string('occupation')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('home_address')->nullable();
            $table->string('office_address')->nullable();
            $table->string('religion')->nullable();
            $table->string('religion_address')->nullable();
            $table->string('religion_center_name')->nullable();
            $table->string('nationality')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('local_government')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')
            ->references('id')
            ->on('customers')
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
        Schema::dropIfExists('customer_guarantors');
    }
}
