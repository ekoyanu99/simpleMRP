@extends('layouts.app')

@section('title', 'Purchase Order')

@section('content_header', 'Purchase Order')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-auto mt-1 ">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddPo">
                        Add New PO
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
                                <select name="po_mstr_vendor" id="po_mstr_vendor" class="form-control form-control-sm"
                                    required>

                                    <option value="">Select Vendor</option>
                                    <option value="1">Supplier A</option>
                                    <option value="2">Supplier B</option>
                                </select>
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
@stop

@push('styles')
@endpush

@push('scripts')
    <script src="{{ asset('js/poMstr/poMstrList.js') }}"></script>
    <script src="{{ asset('js/poMstr/updateModal.js') }}"></script>
@endpush
