<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

class ItemOrder extends SnipeModel
{
    use HasFactory;
    use ValidatingTrait;

    // 0 Abierta, 1 Cerrado, 2 Cancelado

    const STATE_OPEN = 0;
    const STATE_LOAD_OK = 1;
    const STATE_ABORTED = 2;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'items_orders';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    /**
     * Category validation rules
     */
    public $rules = [
        'total'                 => 'required|integer|min:1',
        'purchase_order_id'     => 'required|integer|exists:purchase_orders,id',
        'supplier_id'           => 'required|integer|exists:suppliers,id',
        'item_id'               => 'required|integer',
        'item_type'             => 'required',
    ];

    // 'supplier_id'     => 'exists:suppliers,id|numeric|nullable'

    public function item()
    {
        return $this->morphTo();
    }
    // use Illuminate\Support\Facades\DB;

    public function saveWiouthPurchasseOrder()
    {
        $this->rules = [
            'total'                 => 'required|integer|min:1',
            'purchase_order_id'     => 'required|integer',
            // 'supplier_id'           => 'required|integer|exists:suppliers,id',
            'item_id'               => 'required|integer',
            'item_type'             => 'required',
        ];
        $this->state = ItemOrder::STATE_LOAD_OK;
        $this->purchase_order_id = -1;
        $this->save();
    }

    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class, 'supplier_id');
    }
}
