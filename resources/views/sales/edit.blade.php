@extends('layouts.app')

@section('title', 'Sales Order Detail')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center">
        <h1 class="m-0 mb-2 mb-md-0">
            <i class="fas fa-handshake"></i> Sales Order Detail
        </h1>
        <div>
            <a href="{{ route('SalesMstrs.index') }}" class="btn btn-default btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                {{-- Form Header Sales Order --}}
                <form action="{{ route('SalesMstrs.update', $salesMstr->sales_mstr_uuid) }}" method="post"
                    autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-receipt"></i> Data Header Sales Order</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="sales_mstr_nbr"><i class="fas fa-hashtag text-info"></i> Sales Number</label>
                                <input type="text" name="sales_mstr_nbr" id="sales_mstr_nbr"
                                    class="form-control form-control-sm @error('sales_mstr_nbr') is-invalid @enderror"
                                    value="{{ old('sales_mstr_nbr', $salesMstr->sales_mstr_nbr) }}" readonly>
                                @error('sales_mstr_nbr')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sales_mstr_bill"><i class="fas fa-user text-purple"></i> Bill To</label>
                                <input type="text" name="sales_mstr_bill" id="sales_mstr_bill"
                                    class="form-control form-control-sm @error('sales_mstr_bill') is-invalid @enderror"
                                    placeholder="Nama pelanggan penagih" required
                                    value="{{ old('sales_mstr_bill', $salesMstr->sales_mstr_bill) }}">
                                @error('sales_mstr_bill')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sales_mstr_ship"><i class="fas fa-truck text-orange"></i> Ship To</label>
                                <input type="text" name="sales_mstr_ship" id="sales_mstr_ship"
                                    class="form-control form-control-sm @error('sales_mstr_ship') is-invalid @enderror"
                                    placeholder="Alamat pengiriman" required
                                    value="{{ old('sales_mstr_ship', $salesMstr->sales_mstr_ship) }}">
                                @error('sales_mstr_ship')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sales_mstr_date"><i class="fas fa-calendar-alt text-primary"></i> Order
                                    Date</label>
                                <div class="input-group date" id="sales_mstr_date_picker" data-target-input="nearest">
                                    <input type="date" name="sales_mstr_date" id="sales_mstr_date"
                                        class="form-control form-control-sm datetimepicker-input @error('sales_mstr_date') is-invalid @enderror"
                                        data-target="#sales_mstr_date_picker" required
                                        value="{{ old('sales_mstr_date', $salesMstr->sales_mstr_date) }}">
                                    <div class="input-group-append" data-target="#sales_mstr_date_picker"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    @error('sales_mstr_date')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sales_mstr_due_date"><i class="fas fa-calendar-check text-success"></i> Due
                                    Date</label>
                                <div class="input-group date" id="sales_mstr_due_date_picker" data-target-input="nearest">
                                    <input type="date" name="sales_mstr_due_date" id="sales_mstr_due_date"
                                        class="form-control form-control-sm datetimepicker-input @error('sales_mstr_due_date') is-invalid @enderror"
                                        data-target="#sales_mstr_due_date_picker" required
                                        value="{{ old('sales_mstr_due_date', $salesMstr->sales_mstr_due_date) }}">
                                    <div class="input-group-append" data-target="#sales_mstr_due_date_picker"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    @error('sales_mstr_due_date')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sales_mstr_total"><i class="fas fa-dollar-sign text-danger"></i> Total</label>
                                <input type="number" step="0.01" name="sales_mstr_total" id="sales_mstr_total"
                                    class="form-control form-control-sm @error('sales_mstr_total') is-invalid @enderror"
                                    placeholder="Total nilai Sales Order" required readonly {{-- Biasanya ini dihitung dari detail --}}
                                    value="{{ old('sales_mstr_total', $salesMstr->sales_mstr_total) }}">
                                @error('sales_mstr_total')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-save"></i> Save
                                Changes</button>
                            <a href="{{ route('SalesMstrs.index') }}" class="btn btn-secondary"><i
                                    class="fas fa-times-circle"></i> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-8 col-sm-12">
                <div class="card card-outline card-secondary">
                    <div class="card-header">
                        <div
                            class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center w-100">
                            <h3 class="card-title m-0 mb-2 mb-md-0"><i class="fas fa-list-alt"></i> Sales Order Detail
                            </h3>
                            <div class="card-tools m-0">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#modalAddSalesDet">
                                    <i class="fas fa-plus-circle mr-1"></i> Add Sales Order Detail
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
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
                                                            data-url="{{ url('SalesDets/' . $salesDet->sales_det_uuid) }}"
                                                            data-uuid="{{ $salesDet->sales_det_uuid }}"
                                                            data-toggle="modal" data-target="#editModal">
                                                            <i
                                                                class="fas fa-pen
                                                            "></i>
                                                        </button>

                                                        <form
                                                            action="{{ route('SalesDets.destroy', $salesDet->sales_det_uuid) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus detail ini?')"
                                                                title="Hapus Detail">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
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
    </div>

    <form action="{{ route('SalesDets.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal fade" id="modalAddSalesDet" tabindex="-1" role="dialog"
            aria-labelledby="modalAddSalesDetTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="modalAddSalesDetTitle"><i class="fas fa-plus-circle mr-2"></i> Add
                            Sales Order Detail</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
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
                                <label for="sales_det_date"><i class="fas fa-calendar-alt text-primary"></i> Order
                                    Date</label>
                                <input type="date" name="sales_det_date" id="sales_det_date"
                                    class="form-control form-control-sm @error('sales_det_date') is-invalid @enderror"
                                    placeholder="" required="" value="{{ $salesMstr->sales_mstr_date }}">
                                @error('sales_det_date')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_det_duedate"><i class="fas fa-calendar-check text-success"></i>
                                    Due Date</label>
                                <input type="date" name="sales_det_duedate" id="sales_det_duedate"
                                    class="form-control form-control-sm @error('sales_det_duedate') is-invalid @enderror"
                                    placeholder="" required="" value="{{ $salesMstr->sales_mstr_due_date }}">
                                @error('sales_det_duedate')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>


                            <div class="form-group col-md-6">
                                <label for="sales_det_item"><i class="fas fa-box text-purple"></i> Item</label>

                                <x-adminlte-select2 name="sales_det_item" id="sales_det_item" onchange="getDesc()"
                                    data-dropdown-parent="#modalAddSalesDet">
                                    <option value="">Select an item</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->item_id }}"
                                            {{ old('sales_det_item') == $item->item_id ? 'selected' : '' }}>
                                            {{ $item->item_name }}
                                        </option>
                                    @endforeach
                                </x-adminlte-select2>

                                @error('sales_det_item')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror

                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_det_desc"><i class="fas fa-file-alt text-secondary"></i>
                                    Description</label>
                                <input type="text" name="sales_det_desc" id="sales_det_desc"
                                    class="form-control form-control-sm" readonly required=""
                                    value="{{ old('sales_det_desc') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_det_qty"><i class="fas fa-sort-numeric-up-alt text-info"></i>
                                    Qty</label>
                                <input type="number" name="sales_det_qty" id="sales_det_qty"
                                    class="form-control form-control-sm @error('sales_det_qty') is-invalid @enderror"
                                    required="" value="{{ old('sales_det_qty') }}">
                                @error('sales_det_qty')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_det_price"><i class="fas fa-dollar-sign text-danger"></i>
                                    Price</label>
                                <input type="number" name="sales_det_price" id="sales_det_price"
                                    class="form-control form-control-sm @error('sales_det_price') is-invalid @enderror"
                                    required="" value="{{ old('sales_det_price') }}">
                                @error('sales_det_price')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-times"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Detail</button>
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
                    <input type="hidden" name="sales_det_uuid" id="sales_det_uuid"
                        value="{{ old('sales_det_uuid') }}">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="editModalLabel"><i class="fas fa-edit mr-2"></i> Edit Sales Detail
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="efid_Date" class="form-label"><i
                                        class="fas fa-calendar-alt text-primary"></i> Order Date</label>
                                <input type="date" name="efid_Date" id="efid_Date"
                                    class="form-control form-control-sm w-100 @error('efid_Date') is-invalid @enderror"
                                    required value="{{ old('efid_Date') }}">

                                @error('efid_Date')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="efid_Due" class="form-label"><i
                                        class="fas fa-calendar-check text-success"></i> Due Date</label>
                                <input type="date" name="efid_Due" id="efid_Due"
                                    class="form-control form-control-sm w-100 @error('efid_Due') is-invalid @enderror"
                                    required value="{{ old('efid_Due') }}">
                                @error('efid_Due')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label for="efid_Desc"><i class="fas fa-file-alt text-secondary"></i>
                                    Description</label>
                                <input type="text" id="efid_Desc" name="efid_Desc"
                                    class="form-control form-control-sm" readonly value="{{ old('efid_Desc') }}">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="efid_Qty" class="form-label"><i
                                        class="fas fa-sort-numeric-up-alt text-info"></i> Qty</label>
                                <input type="number" name="efid_Qty" id="efid_Qty"
                                    class="form-control form-control-sm w-100 @error('efid_Qty') is-invalid @enderror"
                                    required value="{{ old('efid_Qty') }}">
                                @error('efid_Qty')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label for="efid_Price" class="form-label"><i class="fas fa-dollar-sign text-danger"></i>
                                    Price</label>
                                <input type="number" name="efid_Price" id="efid_Price"
                                    class="form-control form-control-sm w-100 @error('efid_Price') is-invalid @enderror"
                                    required value="{{ old('efid_Price') }}">
                                @error('efid_Price')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-times"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save
                            Changes</button>
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
        @if ($errors->any())
            $(document).ready(function() {
                if ($('#modalAddSalesDet').find('.is-invalid').length > 0) {
                    $('#modalAddSalesDet').modal('show');
                } else if ($('#editModal').find('.is-invalid').length > 0) {
                    const failedUuid = "{{ old('sales_det_uuid') }}";
                    const updateUrl = "{{ route('SalesDets.update', '') }}" + '/' + failedUuid;
                    $("#editForm").attr("action", updateUrl);
                    $('#editModal').modal('show');
                }
            });
        @endif
    </script>
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
