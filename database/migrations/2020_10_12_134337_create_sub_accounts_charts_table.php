<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubAccountsChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_accounts_charts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('primary_account_id');
            $table->string('sub_account_type');
            $table->string('code',50)->nullable();
            $table->string('name')->nullable();
            $table->string('transaction_type');
            $table->double('opening_balance')->unsigned()->default(0)->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_accounts_charts');
    }
}
