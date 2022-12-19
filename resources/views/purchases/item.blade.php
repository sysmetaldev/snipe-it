@extends('layouts/edit-form', [
'createText' => trans('admin/purchases/general.add_to_order').' '.$item->item->name,
'updateText' => trans('admin/purchases/general.add_to_order').' '.$item->item->name,
'helpPosition' => 'right',
'helpText' => trans('help.itemPur'),
'formAction' => (isset($item->id)) ? route('purchases.updateItem', ['accessory' => $item->id]) :
route('purchases.storeItem'),
])

{{-- Page content --}}
@section('inputFields')
@include ('partials.forms.edit.pur-select', ['translated_name' => trans('admin/purchases/general.select'), 'fieldname'
=> 'purchase_order_id'])
<!-- Cant -->
<div class="form-group {{ $errors->has('total') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="total">{{ trans('admin/purchases/general.cant') }}</label>
    <div class="col-md-7 required">
        <input class="form-control" type="text" name="total" id="total" value="{{ old('total', $item->total) }}" />
        {!! $errors->first('total', '<span class="alert-msg" aria-hidden="true">:message</span>') !!}
    </div>
</div>
<input type="hidden" name="item_id" value="{{ $item->item_id }}" />
<input type="hidden" name="item_type" value="{{ $item->item_type }}" />
<div class="col-md-12">
    <div class="box box-default">
      <div class="box-body">
      <div class="table-responsive">
        {!! $errors->first('supplier_id', '<span class="alert-msg" aria-hidden="true">:message</span>') !!}
        <table
            data-cookie-id-table="suppliersTable"
            data-pagination="true"
            data-id-table="suppliersTable"
            data-search="true"
            data-side-pagination="server"
            data-show-columns="true"
            data-show-fullscreen="false"
            data-show-export="false"
            data-show-refresh="true"
            data-sort-order="asc"
            id="suppliersTable"
            class="table table-striped snipe-table"
            data-url="{{ route('api.suppliers.costs') }}"
            data-export-options='{
            "fileName": "export-suppliers-{{ date('Y-m-d') }}",
            "ignoreColumn": ["actions","image","change","checkbox","checkincheckout","icon"]
            }'>
        <thead>
          <tr>
            <th data-switchable="false" data-formatter="suppliersSelectActionsFormatter"
             data-searchable="false" data-sortable="false" data-field="actions">{{ trans('table.actions') }}</th>
            <th data-sortable="true" data-field="id" data-visible="false">{{ trans('admin/suppliers/table.id') }}</th>
            <th data-sortable="true" data-field="name" data-formatter="suppliersLinkFormatter">{{ trans('admin/suppliers/table.name') }}</th>
            {{-- <th data-sortable="true" data-field="address">{{ trans('admin/suppliers/table.address') }}</th> --}}
            {{-- <th data-searchable="true" data-sortable="true" data-field="contact">{{ trans('admin/suppliers/table.contact') }}</th> --}}
            {{-- <th data-searchable="true" data-sortable="true" data-field="email" data-formatter="emailFormatter">{{ trans('admin/suppliers/table.email') }}</th> --}}
            <th data-searchable="true" data-sortable="true" data-field="phone" data-formatter="phoneFormatter">{{ trans('admin/suppliers/table.phone') }}</th>
            {{-- <th data-searchable="true" data-sortable="true" data-field="fax" data-visible="true">{{ trans('admin/suppliers/table.fax') }}</th>            --}}
          </tr>
        </thead>
      </table>
      </div>
    </div>
  </div>
</div>
@stop

@section('moar_scripts')
@include ('partials.bootstrap-table')
@stop