<div class="input-group">
    <div class="input-group-prepend">
        <button class="btn btn-sm btn-info editButton" data-id="{{ $sales_mstr_id }}" data-date="{{ $sales_mstr_date }}"
            data-due_date="{{ $sales_mstr_due_date }}" data-nbr="{{ $sales_mstr_nbr }}" data-bill="{{ $sales_mstr_bill }}"
            data-ship="{{ $sales_mstr_ship }}" data-url="{{ url('SalesMstrs/' . $sales_mstr_id) }}" data-toggle="modal"
            data-target="#editModal">
            <i class="fas fa-pen"></i>
        </button>

        <a href="{{ url('SalesMstr/' . $sales_mstr_id . '/delete') }}" class="btn btn-sm btn-danger rounded"><i
                class="fas fa-trash" aria-hidden="true"></i></a>
    </div>
</div>
