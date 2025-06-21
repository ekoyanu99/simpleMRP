@extends('layouts.app')

@section('title', 'Purchase Order')

@section('content_header', 'Purchase Order')

@section('content')
    <div class="container-fluid">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center w-100 py-2">
                    <h3 class="card-title m-0">
                        <i class="fas fa-list-ul mr-2"></i>Daftar Purchase Order
                    </h3>

                    <div class="d-flex align-items-center gap-2">
                        <x-action-button-header :show-export="true" />

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAddPo">
                            <i class="fas fa-plus-circle"></i>
                            <span class="d-none d-sm-inline">Add New PO</span>
                            <span class="d-inline d-sm-none"></span>
                        </button>

                        <button type="button" class="btn btn-tool px-2" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover" id="pomstrlistTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>PO Number</th>
                                <th>Supplier</th>
                                <th>Order Date</th>
                                <th>ETD</th>
                                <th>ETA</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>


    <form action="{{ route('PoMstrs.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal fade" id="modalAddPo" tabindex="-1" role="dialog" aria-labelledby="modalAddPoTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New PO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="po_mstr_nbr" class="form-label">
                                    PO Number
                                </label>
                                <input type="text" name="po_mstr_nbr" id="po_mstr_nbr"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ old('po_mstr_nbr') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="po_mstr_vendor" class="form-label">
                                    Vendor
                                </label>
                                <x-adminlte-select2 name="po_mstr_vendor" id="po_mstr_vendor"
                                    data-dropdown-parent="#modalAddPo" required>
                                    <option value="">Select Vendor</option>
                                    <option value="1">Toko Bahan Kue "Berkah Jaya"</option>
                                    <option value="2">Toko Bahan Kue "Sinar Jaya"</option>
                                </x-adminlte-select2>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="po_mstr_date" class="form-label">
                                    Order Date
                                </label>
                                <input type="date" name="po_mstr_date" id="po_mstr_date"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ old('po_mstr_date') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="po_mstr_delivery_date" class="form-label">
                                    ETD
                                </label>
                                <input type="date" name="po_mstr_delivery_date" id="po_mstr_delivery_date"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ old('po_mstr_delivery_date') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="po_mstr_arrival_date" class="form-label">
                                    ETA
                                </label>
                                <input type="date" name="po_mstr_arrival_date" id="po_mstr_arrival_date"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ old('po_mstr_arrival_date') }}">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="po_mstr_remarks" class="form-label">
                                    Remarks
                                </label>
                                <input type="text" name="po_mstr_remarks" id="po_mstr_remarks"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ old('po_mstr_remarks') }}">
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
                        <h5 class="modal-title" id="editModalLabel">Edit Sales Mastr</h5>
                        <button type="button" class="btn btn-sm btn-close" data-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="efid_Due" class="form-label">Due Date</label>
                                <input type="date" name="efid_Due" id="efid_Due"
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

    <form id="addFilterForm" action="" method="post" autocomplete="off" onkeydown="return event.key != 'Enter'">
        <div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="modalFilterLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header"
                        style="background-color: #222149; color: white; border-bottom: 1px solid #dee2e6;">
                        <h5 class="modal-title" id="modalFilterLabel">Filter</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                            style="color: white; font-size: 1.5rem; border: none; background: transparent;">
                            &times;
                        </button>
                    </div>

                    <div class="modal-body" style="background-color: #f8f9fa; color: #212529;">

                        <fieldset class="border p-3 mb-2">
                            <legend class="float-none w-auto px-2 fw-bold text-danger" style="font-size: 12px;">Click the
                                filter button to start searching. If you want to
                                reset the filter, please click the reset button.</legend>
                            </legend>
                            <div class="row">

                                <x-adminlte-input id="f_po_mstr_nbr" name="f_po_mstr_nbr" label="Po Number"
                                    placeholder="Search by Po Number" fgroup-class="col-md-6" />

                                <x-adminlte-input id="f_po_mstr_vd" name="f_po_mstr_vd" label="Vendor"
                                    placeholder="Search by Vendor" fgroup-class="col-md-6" />

                            </div>
                            <div class="flex-sb-m w-full p-t-15 p-b-20 d-flex align-items-center">
                                <span class="form-check">
                                    <label class="form-check-label" for="isExactMatch">
                                        <input class="form-check-input me-2" type="checkbox" name="isExactMatch"
                                            id="isExactMatch" value="0"
                                            onchange="this.value = this.checked ? 1 : 0">
                                        Exact Match
                                    </label>
                                </span>
                            </div>
                        </fieldset>

                    </div>
                    <div class="modal-footer"
                        style="background-color: #f8f9fa; color: #212529; border-top: solid 1px #ece0ea;">

                        <x-action-button-filter />

                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@push('styles')
@endpush

@push('scripts')
    <script src="{{ asset('js/poMstr/poMstrList.js') }}"></script>
    <script src="{{ asset('js/poMstr/updateModal.js') }}"></script>
@endpush
