<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Supplier;

class Items extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'snipeit:items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $suppliers = Supplier::select(
            ['suppliers.id', 'suppliers.name', 'suppliers.phone', 'items_orders.purchase_cost' ]
        )->leftJoin('items_orders', function ($join) {
            $join->on('items_orders.supplier_id', '=', 'suppliers.id')
                ->where('items_orders.item_id', '=', 12);
        })
            ->get();
        foreach ($suppliers as $supli) {
            echo $supli->name .'--'.$supli->purchase_cost.PHP_EOL;
        }
        return 0;
    }
}
