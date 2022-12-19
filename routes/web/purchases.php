<?php

use App\Http\Controllers\PurchaseOrderController;
use Illuminate\Support\Facades\Route;

/*
* PurchaseOrder
 */

Route::group(['prefix' => 'purchases', 'middleware' => ['auth']], function () {
    Route::get(
        'item/{type}/{id?}',
        [PurchaseOrderController::class, 'createItem']
    )->name('purchases.item');
    Route::post(
        'storeItem',
        [PurchaseOrderController::class, 'storeItem']
    )->name('purchases.storeItem');
});

Route::resource('purchases', PurchaseOrderController::class, [
    'middleware' => ['auth'],
    'parameters' => ['purchase' => 'purchase_id'],
]);

// Route::resource('accessories', , [
//     'middleware' => ['auth'],
//     'parameters' => ['accessory' => 'accessory_id'],
// ]);