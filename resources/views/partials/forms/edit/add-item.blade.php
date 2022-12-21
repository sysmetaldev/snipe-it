<div id="assigned_user" class="form-group">
    {{ Form::label('item-id', $translated_name, array('class' => 'col-md-3 control-label')) }}
    <div class="col-md-1 col-sm-1 text-left">
        <a href='{{ route('modal.show', 'item') }}' data-toggle="modal"  data-target="#createModal" data-select='item_select' class="btn btn-sm btn-primary">{{ trans('button.new') }}</a>
    </div>
</div>