<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPurchaseMontItemOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items_orders', function (Blueprint $table) {
            $table->decimal('base_cost', 8, 2)->nullable();
            $table->decimal('purchase_cost', 8, 2)->nullable();
            // 0 Sin cargar, 1 Cargada, 2 Cancelado
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items_orders', function (Blueprint $table) {
            $table->dropColumn('base_cost');
            $table->dropColumn('purchase_cost');
        });
    }
}
