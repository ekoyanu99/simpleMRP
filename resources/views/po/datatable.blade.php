<div class="input-group">
    <div class="input-group-prepend">
        <button class="btn btn-sm btn-info editButton" data-id="{{ $po_mstr_id }}"
            data-delivery="{{ $po_mstr_delivery_date }}" data-arrival="{{ $po_mstr_arrival_date }}"
            data-nbr="{{ $po_mstr_nbr }}" data-vendor="{{ $po_mstr_vendor }}"
            data-url="{{ url('PoMstrs/' . $po_mstr_id) }}" data-toggle="modal" data-target="#editModal">
            <i class="fas fa-pen"></i>
        </button>

        <a href="{{ url('PoMstr/' . $po_mstr_id . '/delete') }}" class="btn btn-sm btn-danger rounded"><i
                class="fas fa-trash" aria-hidden="true"></i></a>

        <a href="{{ url('PoMstrs/' . $po_mstr_id . '') }}" class="btn btn-sm btn-primary rounded">
            <i class="fas fa-folder" aria-hidden="true"></i>
        </a>
    </div>
</div>
