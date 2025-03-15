@extends('layouts.app')

@section('title', 'Sales Order')

@section('content_header', 'Sales Order')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-auto mt-1 ">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddSales">
                        Add New Sales
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover" id="salesmstrlistTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sales Number</th>
                            <th>Bill To</th>
                            <th>Ship To</th>
                            <th>Order Date</th>
                            <th>Due Date</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>

            </div>

        </div>
    </div>

    <form action="{{ route('SalesMstrs.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal fade" id="modalAddSales" tabindex="-1" role="dialog" aria-labelledby="modalAddSalesTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Sales</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="sales_mstr_nbr" class="form-label">
                                    Sales Number
                                </label>
                                <input type="text" name="sales_mstr_nbr" id="sales_mstr_nbr"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ old('sales_mstr_nbr') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sales_mstr_bill" class="form-label">
                                    Bill To
                                </label>
                                <input type="text" name="sales_mstr_bill" id="sales_mstr_bill"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ old('sales_mstr_bill') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_mstr_ship" class="form-label">
                                    Ship To
                                </label>
                                <input type="text" name="sales_mstr_ship" id="sales_mstr_ship"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ old('sales_mstr_ship') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_mstr_date" class="form-label">
                                    Date Order
                                </label>
                                <input type="date" name="sales_mstr_date" id="sales_mstr_date"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ old('sales_mstr_date') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_mstr_due_date" class="form-label">
                                    Due Date
                                </label>
                                <input type="date" name="sales_mstr_due_date" id="sales_mstr_due_date"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ old('sales_mstr_due_date') }}">
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
    <script src="{{ asset('js/salesMstr/salesMstrList.js') }}"></script>
    <script src="{{ asset('js/salesMstr/updateModal.js') }}"></script>
@endpush
