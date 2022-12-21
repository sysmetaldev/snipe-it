<div id="{{ $fieldname }}" class="form-group{{ $errors->has($fieldname) ? ' has-error' : '' }}">
    {{ Form::label($fieldname, $translated_name, array('class' => 'col-md-3 control-label')) }}
    <div class="col-md-7 required">
        <select class="js-data-ajax" data-endpoint="pur-open" data-placeholder="{{ $translated_name }}" name="{{ $fieldname }}" style="width: 100%" id="pur_select" aria-label="{{ $fieldname }}" required>
            @if ($pur_id = old($fieldname, (isset($item)) ? $item->{$fieldname} : ''))
                <option value="{{ $pur_id }}" selected="selected" role="option" aria-selected="true"  role="option">
                    {{ (\App\Models\PurchaseOrder::find($pur_id)) ? \App\Models\PurchaseOrder::find($pur_id)->name : '' }}
                </option>
            @else
                <option value="" role="option">{{ trans('general.select_supplier') }}</option>
            @endif
        </select>
    </div>    
    {!! $errors->first($fieldname, '<div class="col-md-8 col-md-offset-3"><span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span></div>') !!}
</div>
