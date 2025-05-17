<div class="input-group">
    <div class="input-group-prepend">
        <button class="btn btn-sm btn-info editButton" data-id="{{ $in_det->in_det_id }}"
            data-item="{{ $itemMstr->item_name }}" data-qty="{{ $in_det->in_det_qty }}"
            data-itemdesc="{{ $itemMstr->item_desc }}" data-toggle="modal"
            data-url="{{ url('InDets/' . $in_det->in_det_id) }}" data-toggle="modal" data-target="#editModal">
            <i class="fas fa-pen"></i>
        </button>
    </div>
</div>
