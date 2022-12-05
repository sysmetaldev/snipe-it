<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemOrder;
use App\Models\Traits\Searchable;

class PurchaseOrder extends SnipeModel
{
    const STATES = [
        'INITIAL' => 0,
        'SEND' => 1,
        'RECEIVED' => 2,
        'CLOSED' => 3,
        'ABORTED' => 4
    ];

    use HasFactory;
    use Searchable;


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
        'name'          => 'required|min:1|max:255',
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
            case 0:
                $salida = 'En proceso';
                break;
            case 1:
                $salida = 'Enviado';
                break;
            case 2:
                $salida = 'Recibido';
                break;
            case 3:
                $salida = 'Cerrado';
                break;
            case 4:
                $salida = 'Cancelado';
                break;
            default:
                $salida = 'Invalido';
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
}
