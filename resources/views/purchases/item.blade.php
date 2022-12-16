@extends('layouts/edit-form', [
    'createText' => trans('admin/purchases/general.add_to_order').$item->name,
    'updateText' => trans('admin/purchases/general.add_to_order').$item->name,
    'helpPosition'  => 'right',
    'helpText' => trans('help.accessories'),
    'formAction' => (isset($item->id)) ? route('accessories.update', ['accessory' => $item->id]) : route('accessories.store'),
])

{{-- Page content --}}
@section('inputFields')
@include ('partials.forms.edit.pur-select', ['translated_name' => trans('admin/purchases/general.select'), 'fieldname' => 'pur_id'])
@stop

@section('moar_scripts')
@include ('partials.bootstrap-table')
@stop