<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('loan_officer_id')->nullable();
            $table->string('branch_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number')->unique();
            $table->string('uuid')->unique();
            $table->string('bvn_phone_number')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('bvn_verified')->default(0);
            $table->boolean('name_is_verified')->default(0);
            $table->string('avatar')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('religion_address')->nullable();
            $table->string('religion_center_name')->nullable();

            $table->string('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('occupation')->nullable();
            $table->string('id_card_type')->nullable();
            $table->string('id_card_number')->nullable();
            $table->string('registration_step_status')->nullable();            $table->rememberToken();
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
        Schema::dropIfExists('customers');
    }
}
