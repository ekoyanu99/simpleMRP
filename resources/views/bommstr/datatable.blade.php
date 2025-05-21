<div class="input-group">
    <div class="input-group-prepend">
        {{-- <button class="btn btn-sm btn-info editButton" data-id="{{ $item_id }}" data-desc="{{ $item_desc }}"
            data-url="{{ url('ItemMstrs/' . $item_id) }}" data-toggle="modal" data-target="#editModal">
            <i class="fas fa-pen"></i>
        </button> --}}

        <a href="{{ url('BomMstr/' . $bom_mstr_id . '/delete') }}" class="btn btn-sm btn-danger rounded"><i
                class="fas fa-trash" aria-hidden="true"></i></a>
    </div>
</div>
