<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_charts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',50)->nullable();
            $table->string('name')->nullable();
            $table->string('type');
            $table->string('transaction_type')->nullable();;
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
        Schema::dropIfExists('accounts_charts');
    }
}
