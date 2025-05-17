@extends('layouts.app')

@section('title', 'Sales Order Detail')

@section('content_header', 'Sales Order Detail')

@section('content')

    <div class="row">
        <div class="col-md-4 col-sm-12">
            {{-- data header --}}
            <form class="" action="{{ route('SalesMstrs.update', $salesMstr->sales_mstr_id) }}" method="post"
                autocomplete="off">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="sales_mstr_nbr" class="form-label">
                                    Sales Number
                                </label>
                                <input type="text" name="efid_nbr" id="sales_mstr_nbr"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $salesMstr->sales_mstr_nbr }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sales_mstr_bill" class="form-label">
                                    Bill To
                                </label>
                                <input type="text" name="efid_bill" id="sales_mstr_bill"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $salesMstr->sales_mstr_bill }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_mstr_ship" class="form-label">
                                    Ship To
                                </label>
                                <input type="text" name="efid_ship" id="sales_mstr_ship"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $salesMstr->sales_mstr_ship }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_mstr_date" class="form-label">
                                    Date Order
                                </label>
                                <input type="date" name="efid_date" id="sales_mstr_date"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $salesMstr->sales_mstr_date }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_mstr_due_date" class="form-label">
                                    Due Date
                                </label>
                                <input type="date" name="efid_Due" id="sales_mstr_due_date"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $salesMstr->sales_mstr_due_date }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_mstr_total" class="form-label">
                                    Total
                                </label>
                                <input type="number" name="efid_Total" id="sales_mstr_total"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $salesMstr->sales_mstr_total }}">
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> </button>
                    </div>
                </div>


            </form>
        </div>

        <div class="col-md-8 col-sm-12">
            {{-- data detail --}}
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-auto mt-1 ">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#modalAddSalesDet">
                                Add New Sales Detail
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped table-hover" id="salesDetTable">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 30%;">Sales Number</th>
                                    <th style="width: 15%;">Item</th>
                                    <th style="width: 30%">Desc</th>
                                    <th style="width: 5%;">Qty</th>
                                    <th style="width: 5%;">Price</th>
                                    <th style="width: 10%;">Total</th>
                                    <th style="width: 10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salesMstr->salesDet as $salesDet)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $salesMstr->sales_mstr_nbr }}</td>
                                        <td>{{ $salesDet->itemMstr->item_name }}</td>
                                        <td>{{ $salesDet->sales_det_desc }}</td>
                                        <td>{{ $salesDet->sales_det_qty ? formatNumberV2($salesDet->sales_det_qty) : $salesDet->sales_det_qty }}
                                        </td>
                                        <td>{{ $salesDet->sales_det_price ? formatCurrency($salesDet->sales_det_price) : $salesDet->sales_det_price }}
                                        </td>
                                        <td>{{ $salesDet->sales_det_qty * $salesDet->sales_det_price ? formatCurrency($salesDet->sales_det_qty * $salesDet->sales_det_price) : $salesDet->sales_det_qty * $salesDet->sales_det_price }}
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-sm btn-info editButton"
                                                        data-id="{{ $salesDet->sales_det_id }}"
                                                        data-date="{{ $salesDet->sales_det_date }}"
                                                        data-due_date="{{ $salesDet->sales_det_duedate }}"
                                                        data-item="{{ $salesDet->sales_det_item }}"
                                                        data-desc="{{ $salesDet->sales_det_desc }}"
                                                        data-qty="{{ $salesDet->sales_det_qty }}"
                                                        data-price="{{ $salesDet->sales_det_price }}"
                                                        data-url="{{ url('SalesDets/' . $salesDet->sales_det_id) }}"
                                                        data-toggle="modal" data-target="#editModal">
                                                        <i
                                                            class="fas fa-pen
                                                        "></i>
                                                    </button>

                                                    <a href="{{ url('SalesDet/' . $salesDet->sales_det_id . '/delete') }}"
                                                        class="btn btn-sm btn-danger rounded"><i class="fas fa-trash"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>

    </div>

    <form action="{{ route('SalesDets.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal fade" id="modalAddSalesDet" tabindex="-1" role="dialog"
            aria-labelledby="modalAddSalesDetTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Sales Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row mb-4">

                            <div class="form-group col-md-6 d-none">
                                <label for="sales_det_mstr" class="form-label">
                                    sales_det_mstr
                                </label>
                                <input type="text" name="sales_det_mstr" id="sales_det_mstr"
                                    class="form-control form-control-sm" readonly required=""
                                    value="{{ $salesMstr->sales_mstr_id }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_det_date" class="form-label">
                                    Date Order
                                </label>
                                <input type="date" name="sales_det_date" id="sales_det_date"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $salesMstr->sales_mstr_date }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_det_duedate" class="form-label">
                                    Due Date
                                </label>
                                <input type="date" name="sales_det_duedate" id="sales_det_duedate"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $salesMstr->sales_mstr_due_date }}">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="sales_det_item" class="form-label">
                                    Item
                                </label>

                                <select name="sales_det_item" id="sales_det_item" class="form-control form-control-sm"
                                    required onchange="getDesc()">
                                    <option value="">Select Item</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->item_mstr_id }}">{{ $item->item_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_det_desc" class="form-label">
                                    Description
                                </label>
                                <input type="text" name="sales_det_desc" id="sales_det_desc"
                                    class="form-control form-control-sm" readonly required=""
                                    value="{{ old('sales_det_desc') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_det_qty" class="form-label">
                                    Qty
                                </label>
                                <input type="number" name="sales_det_qty" id="sales_det_qty"
                                    class="form-control form-control-sm" required=""
                                    value="{{ old('sales_det_qty') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_det_price" class="form-label">
                                    Price
                                </label>
                                <input type="number" name="sales_det_price" id="sales_det_price"
                                    class="form-control form-control-sm" required=""
                                    value="{{ old('sales_det_price') }}">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Sales Detail</h5>
                        <button type="button" class="btn btn-sm btn-close" data-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="efid_Date" class="form-label">Date</label>
                                <input type="date" name="efid_Date" id="efid_Date"
                                    class="form-control form-control-sm w-100" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="efid_Due" class="form-label">Due Date</label>
                                <input type="date" name="efid_Due" id="efid_Due"
                                    class="form-control form-control-sm w-100" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="efid_Qty" class="form-label">Qty</label>
                                <input type="number" name="efid_Qty" id="efid_Qty"
                                    class="form-control form-control-sm w-100" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="efid_Price" class="form-label">Price</label>
                                <input type="number" name="efid_Price" id="efid_Price"
                                    class="form-control form-control-sm w-100" required>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('styles')
@endpush

@push('scripts')
    <script>
        getDesc = () => {
            let item_id = document.getElementById('sales_det_item').value;
            console.log(item_id);
            let url = "{{ url('GetDesc') }}/" + item_id;
            console.log(url);
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('sales_det_desc').value = data.item_desc;
                });
        }
    </script>
    <script src="{{ asset('js/salesDet/salesDet.js') }}"></script>
    <script src="{{ asset('js/salesDet/updateModal.js') }}"></script>
@endpush
