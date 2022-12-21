<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ItemOrder;
use App\Models\Traits\Searchable;
use Watson\Validating\ValidatingTrait;
use DB;

class PurchaseOrder extends SnipeModel
{
    const STATE_INITIAL = 0;
    const STATE_PRE_SEND = 1; // Pendiente de aprobacion por un supervisor
    const STATE_SEND = 2;
    const STATE_RECEIVED = 3;
    const STATE_CLOSED = 4;
    const STATE_ABORTED = 5;

   
    use HasFactory;
    use Searchable;
    use ValidatingTrait;

    /**
     * The attributes that should be included when searching the model.
     * 
     * @var array
     */
    protected $searchableAttributes = ['name', 'id', 'state'];

    /**
     * The relations and their attributes that should be included when searching the model.
     * 
     * @var array
     */
    protected $searchableRelations = [
        'user'     => ['username']
    ];


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'purchase_orders';

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
        'name'          => 'required|min:3|max:255',
        'state'         => 'required'
    ];

    // public function existItemAsset(int $id): bool
    // {
    //     return ItemOrder::where(['item_id' => $id, 'item' => Asset::class])->count() > 0;
    // }   
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function itemOrders()
    {
        return $this->hasMany(ItemOrder::class);
    }

    public function textState()
    {

        $salida = 'CERO';
        switch ($this->state) {
            case PurchaseOrder::STATE_INITIAL:
                $salida = 'En proceso';
                break;
            case PurchaseOrder::STATE_PRE_SEND:
                $salida = 'Pendiente de aprobacion';
                break;
            case PurchaseOrder::STATE_SEND:
                $salida = 'Enviado a provedores';
                break;
            case PurchaseOrder::STATE_RECEIVED:
                $salida = 'Recibido';
                break;
            case PurchaseOrder::STATE_CLOSED:
                $salida = 'Cerrado';
                break;
            default:
                $salida = 'Cancelado';
                break;
        }
        return $salida;
    }

    /**
     * Query builder scope to order on category
     *
     * @param  \Illuminate\Database\Query\Builder  $query  Query builder instance
     * @param  text                              $order       Order
     *
     * @return \Illuminate\Database\Query\Builder          Modified query builder
     */
    public function scopeOrderUser($query, $order)
    {
        return $query->leftJoin('users', 'purchase_orders.user_id', '=', 'users.id')
            ->orderBy('users.username', $order);
    }

    public function scopeStateName($query, $state)
    {
        return $this->textState();
    }
    public function scopeItemsForShow($query, $id = null, $type)
    {

        if (Setting::getSettings()->show_archived_in_list != 1) {
            return $query->join('items_orders', 'purchase_orders.id', '=', 'items_orders.purchase_order_id')
                ->where([
                    ['purchase_orders.id', '=', $id],
                    ['items_orders.item_type', '=', $type]
                ]);
        } else {
            return $query;
        }
    }


    public function allItems($name)
    {

        $assets_query = DB::table('assets')->select('id', 'name', /* DB::raw('"Conjunto" as tipo'), */ 'image');
        $consumables_query = DB::table('consumables')->select('id', 'name', /* DB::raw('"Consumible" as tipo'), */ 'image');
        $accesories_query = DB::table('accessories')->select('id', 'name', /* DB::raw('"Accesorio" as tipo'), */ 'image');
        $components_query = DB::table('components')->select('id', 'name', /* DB::raw('"Componente" as tipo'), */ 'image');
        $items = $assets_query->union($consumables_query)->union($accesories_query)
            ->union($components_query);

        if ($name !== null) {
            $items = $items->where('name', 'LIKE', '%' . $name . '%');
        }
        return $items->orderBy('name', 'ASC')->paginate(50);
    }
}
