<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInitiarDatePurchase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->integer('user_id');
            $table->index('user_id');
            $table->date('initial_date')->nullable();
            $table->date('recibed_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('initial_date');
            $table->dropColumn('recibed_date');
            $table->dropIndex('user_id');
        });
    }
}
