<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_verifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->boolean('given_id_card')->default(0);
            $table->boolean('given_bank_statement')->default(0);
            $table->boolean('given_utility_bill')->default(0);
            $table->boolean('given_others')->default(0);
            $table->string('id_card_type')->nullable();
            $table->string('id_card_issued')->nullable();
            $table->string('id_card_expire')->nullable();
            $table->integer('bvn')->nullable();
            $table->longText('documents');
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
        Schema::dropIfExists('customer_verifications');
    }
}
