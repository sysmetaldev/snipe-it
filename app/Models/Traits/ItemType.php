<?php

namespace App\Models\Traits;


use Illuminate\Support\Facades\DB;
use App\Models\ItemOrder;

/**
 * Para guardar/actualizar items con historial de provedores
 *
 * @author Guillermo Beltramino <guillobeltra84@gmail.com>
 */
trait ItemType
{

    public function saveWiouthPurchasseOrder($supplier_id = null)
    {
        return DB::transaction(function () use ($supplier_id) {
            $con = $this->save();
            if ($con && $supplier_id) {
                $itemOrder = new ItemOrder();
                $itemOrder->purchase_order_id = null;
                $itemOrder->item_id = $this->id;
                $itemOrder->item_type = this::class;
                $itemOrder->total = $this->qty;
                $itemOrder->total_final = $this->qty;
                $itemOrder->base_cost = $this->purchase_cost;
                $itemOrder->purchase_cost = $this->purchase_cost;
                $itemOrder->supplier_id = $supplier_id;
                
                // $itemOrder->purchase_
                $itemOrder->saveWiouthPurchasseOrder();
            }
            return $con;
        });
    }
}
