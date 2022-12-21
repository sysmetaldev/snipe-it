<?php

namespace App\Http\Transformers;

use App\Helpers\Helper;
use App\Models\ItemOrder;
use Illuminate\Database\Eloquent\Collection;

class ItemOrderTransformer
{

    public function ItemOrderTransformer(Collection $itemsOrders, $total)
    {
        $array = [];
        foreach ($itemsOrders as $item) {
            $array[] = self::transformItemOrder($item);
        }

        // dd($array); die;

        return (new DatatablesTransformer)->transformDatatables($array, $total);
    }

    public function transformItemOrder(ItemOrder $item)
    {

        $array = [
            'id' => $item->id,
            'item' => [
                'id' => $item->item->id,
                'name' => e($item->item->name),
                'type' => e($this->classToType($item->item_type))
            ],
            'state' => '$item->textState()',
            'created_at' => Helper::getFormattedDateObject($item->created_at, 'datetime'),
            'updated_at' => Helper::getFormattedDateObject($item->updated_at, 'datetime'),

        ];

        // $permissions_array['available_actions'] = [
        //     'checkout' => Gate::allows('checkout', Accessory::class),
        //     'checkin' =>  false,
        //     'update' => Gate::allows('update', Accessory::class),
        //     'delete' => Gate::allows('delete', Accessory::class),
        // ];

        // $permissions_array['user_can_checkout'] = false;

        // if ($accessory->numRemaining() > 0) {
        //     $permissions_array['user_can_checkout'] = true;
        // }

        // $array += $permissions_array;

        return $array;
    }

    private function classToType($className): string
    {
        if (str_contains($className, 'Consum')) {
            return 'Consumible';
        }
        if (str_contains($className, 'Compo')) {
            return 'Componente';
        }
        if (str_contains($className, 'Acce')) {
            return 'Accesorio';
        }
        if (str_contains($className, 'Asset')) {
            return 'Conjunto';
        }
        return '';
    }

    public function transformCheckedoutAccessory($accessory, $accessory_users, $total)
    {
        $array = [];

        foreach ($accessory_users as $user) {
            $array[] = [

                'assigned_pivot_id' => $user->pivot->id,
                'id' => (int) $user->id,
                'username' => e($user->username),
                'name' => e($user->getFullNameAttribute()),
                'first_name' => e($user->first_name),
                'last_name' => e($user->last_name),
                'employee_number' =>  e($user->employee_num),
                'checkout_notes' => e($user->pivot->note),
                'last_checkout' => Helper::getFormattedDateObject($user->pivot->created_at, 'datetime'),
                'type' => 'user',
                'available_actions' => ['checkin' => true],
            ];
        }

        return (new DatatablesTransformer)->transformDatatables($array, $total);
    }
}
