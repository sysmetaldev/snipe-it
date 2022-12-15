@extends('layouts/edit-form', [
'createText' => trans('admin/purchases/general.create') ,
'updateText' => trans('admin/purchases/general.update'),
'helpPosition' => 'right',
'helpText' => trans('help.purchases'),
'formAction' => (isset($item->id)) ? route('purchases.update', ['purchase' => $item->id]) : route('purchases.store'),
])

{{-- Page content --}}
@section('inputFields')

@include ('partials.forms.edit.name', ['translated_name' => trans('admin/purchases/general.title')])
@include ('partials.forms.edit.user-select', ['translated_name' => trans('general.user_to'), 'fieldname' =>
'user_id','required' => 'true'])

@if (isset($item->id))

<div class="form-group">
    {{ Form::label('pur-state', trans('general.state_name'), array('class' => 'col-md-3 control-label')) }}
    <div class="col-md-6">
        <div id="pur-state" class="form-control">  
            {{ \App\Models\PurchaseOrder::StateName($item->state) }} 
        </div>
    </div>
</div>

<div class="row">         
    <div class="col-lg-3 col-xs-6">
        <a href="{{ route('hardware.index') }}">
            <!-- small box -->
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>{{ number_format(\App\Models\PurchaseOrder::ItemsForShow($item->id,'App\Models\Asset')->count())
                        }}</h3>
                    <p>{{ strtolower(trans('general.assets')) }}</p>
                </div>
                <div class="icon" aria-hidden="true">
                    <i class="fas fa-barcode" aria-hidden="true"></i>
                </div>
                @can('index', \App\Models\Asset::class)
                <a href="{{ route('hardware.index') }}" class="small-box-footer">{{ trans('general.view_all') }} <i
                        class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                @endcan
            </div>
        </a>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="{{ route('accessories.index') }}">
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3>{{
                        number_format(\App\Models\PurchaseOrder::ItemsForShow($item->id,'App\Models\Accessory')->count())
                        }}</h3>
                    <p>{{ strtolower(trans('general.accessories')) }}</p>
                </div>
                <div class="icon" aria-hidden="true">
                    <i class="far fa-keyboard"></i>
                </div>
                @can('index', \App\Models\Accessory::class)
                <a href="{{ route('accessories.index') }}" class="small-box-footer">{{ trans('general.view_all') }} <i
                        class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                @endcan
            </div>
        </a>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->

        <a href="{{ route('consumables.index') }}">
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>{{
                        number_format(\App\Models\PurchaseOrder::ItemsForShow($item->id,'App\Models\Consumable')->count())
                        }}</h3>
                    <p>{{ strtolower(trans('general.consumables')) }}</p>
                </div>
                <div class="icon" aria-hidden="true">
                    <i class="fas fa-tint"></i>
                </div>
                @can('index', \App\Models\Consumable::class)
                <a href="{{ route('consumables.index') }}" class="small-box-footer">{{ trans('general.view_all') }} <i
                        class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                @endcan
            </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <a href="{{ route('components.index') }}">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{
                        number_format(\App\Models\PurchaseOrder::ItemsForShow($item->id,'App\Models\Component')->count())
                        }}</h3>
                    <p>{{ strtolower(trans('general.components')) }}</p>
                </div>
                <div class="icon" aria-hidden="true">
                    <i class="far fa-hdd"></i>
                </div>
                @can('view', \App\Models\License::class)
                <a href="{{ route('components.index') }}" class="small-box-footer">{{ trans('general.view_all') }} <i
                        class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                @endcan
            </div>
        </a>
    </div><!-- ./col -->
</div>
@endif

@stop