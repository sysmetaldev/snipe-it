<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersPurchaseOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->integer('user_id_send');
            $table->index('user_id_send');
            $table->integer('user_id_received');
            $table->index('user_id_received');
            $table->integer('user_id_close');
            $table->index('user_id_close');
            $table->integer('user_id_aborted');
            $table->index('user_id_aborted');
            $table->date('send_date')->nullable();
            $table->date('received_date')->nullable();
            $table->date('close_date')->nullable();
            $table->date('aborted_date')->nullable();
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
            $table->dropColumn('user_id_send');
            $table->dropColumn('user_id_received');
            $table->dropColumn('user_id_close');
            $table->dropColumn('user_id_aborted');
            $table->dropColumn('send_date');
            $table->dropColumn('received_date');
            $table->dropColumn('close_date');
            $table->dropColumn('aborted_date');
            $table->dropIndex('user_id_received');
            $table->dropIndex('user_id_close');
            $table->dropIndex('user_id_aborted');
            $table->dropIndex('user_id_send');
        });
    }
}
