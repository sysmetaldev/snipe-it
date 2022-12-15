<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseOrderRequest;
use App\Http\Requests\UpdatePurchaseOrderRequest;
use App\Models\PurchaseOrder;
use App\Http\Requests\ImageUploadRequest;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', PurchaseOrder::class);
        return view('purchases/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', PurchaseOrder::class);
        // $category_type = 'accessory';

        return view('purchases/edit')
            ->with('item', new PurchaseOrder());
    }

    public function store(ImageUploadRequest $request)
    {
        $this->authorize(PurchaseOrder::class);
        $purchase = new PurchaseOrder();

        // // Update the accessory data
        $purchase->name                    = request('name');
        $purchase->user_id                  = request('user_id');
        $purchase->state  = PurchaseOrder::STATES['INITIAL'];
        // $accessory->category_id             = request('category_id');
        // $accessory->location_id             = request('location_id');
        // $accessory->min_amt                 = request('min_amt');
        // $accessory->company_id              = Company::getIdForCurrentUser(request('company_id'));
        // $accessory->order_number            = request('order_number');
        // $accessory->manufacturer_id         = request('manufacturer_id');
        // $accessory->model_number            = request('model_number');
        // $accessory->purchase_date           = request('purchase_date');
        // $accessory->purchase_cost           = Helper::ParseCurrency(request('purchase_cost'));
        // $accessory->qty                     = request('qty');
        // $accessory->user_id                 = Auth::user()->id;
        // $accessory->supplier_id             = request('supplier_id');
        // $accessory->notes                   = request('notes');
        // $accessory->money                   = request('money', 'ARG');

        // $accessory = $request->handleImages($accessory);

        // Was the accessory created?
        if ($purchase->save()) {
            // Redirect to the new accessory  page
            return redirect()->route('purchases.edit', $purchase->id)->with('success', trans('admin/purchases/message.create.success'));
        }

        return redirect()->back()->withInput()->withErrors($purchase->getErrors());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit($purID = null)
    {
        $this->authorize('update', PurchaseOrder::class);
        if ($item = PurchaseOrder::find($purID)) {
            return view('purchases/edit')
            ->with('item', $item);
        }
        return redirect()->route('models.index')->with('error', trans('admin/models/message.does_not_exist'));
     
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseOrderRequest  $request
     * @param  int  $purchaseOrder
     * @return \Illuminate\Http\Response
     */        
    public function update(UpdatePurchaseOrderRequest $request, $purchaseOrder = null)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }
}
