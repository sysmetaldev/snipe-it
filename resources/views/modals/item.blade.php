{{-- See snipeit_modals.js for what powers this --}}
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h2 class="modal-title">
                {{ trans('admin/purchases/general.load_item') }}
            </h2>
        </div>
        <div class="modal-body">
            <form action="{{ route('api.categories.store') }}" onsubmit="return false">
                {{ csrf_field() }}
                <div class="alert alert-danger" id="modal_error_msg" style="display:none">
                </div>
                @include ('partials.forms.edit.item-select', ['translated_name' => trans('general.item_to_load'), 'fieldname' => 'purchase-item-item_id', 'required' => 'true'])
                <div class="dynamic-form-row">
                    <div class="col-md-3">
                        <label for="modal-number">{{ trans('general.quantity') }}:</label>
                    </div>
                    <div class="col-md-7 required">
                        <input type="number" min="0" value="0" ondrop="return false;" onpaste="return false;" name='purchase-item-total' id='modal-number' class="form-control">
                    </div>
                </div>
                @include ('partials.forms.edit.supplier-select', ['translated_name' => trans('general.supplier'), 'fieldname' => 'purchase-item-supplier_id', 'hide_new' => 'true', 'hide_div_parent' => 'true', 'required' => 'true'])
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('button.cancel') }}</button>
            <button type="button" class="btn btn-primary" id="modal-save">{{ trans('general.save') }}</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->