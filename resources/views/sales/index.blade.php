@extends('layouts.app')

@section('title', 'Sales Order')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center">
        <h1 class="m-0 mb-2 mb-md-0">
            <i class="fas fa-handshake"></i> Sales Order
        </h1>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div
                    class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center w-100">
                    <h3 class="card-title m-0 mb-2 mb-md-0"><i class="fas fa-list-ul"></i> Daftar Sales Order</h3>
                    <div class="card-tools m-0">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#modalAddSales">
                            <i class="fas fa-plus-circle mr-1"></i> Add New Sales
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
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
    </div>


    <form action="{{ route('SalesMstrs.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal fade" id="modalAddSales" tabindex="-1" role="dialog" aria-labelledby="modalAddSalesTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="modalAddSalesTitle"><i class="fas fa-plus-circle mr-2"></i> Add New
                            Sales</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="sales_mstr_nbr"><i class="fas fa-hashtag text-info"></i> Sales Number</label>
                                <input type="text" name="sales_mstr_nbr" id="sales_mstr_nbr"
                                    class="form-control form-control-sm @error('sales_mstr_nbr') is-invalid @enderror"
                                    value="{{ old('sales_mstr_nbr') }}">
                                @error('sales_mstr_nbr')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_mstr_bill"><i class="fas fa-user text-purple"></i> Bill To</label>
                                <input type="text" name="sales_mstr_bill" id="sales_mstr_bill"
                                    class="form-control form-control-sm @error('sales_mstr_bill') is-invalid @enderror"
                                    placeholder="Nama pelanggan penagih" required value="{{ old('sales_mstr_bill') }}">
                                @error('sales_mstr_bill')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_mstr_ship"><i class="fas fa-truck text-orange"></i> Ship To</label>
                                <input type="text" name="sales_mstr_ship" id="sales_mstr_ship"
                                    class="form-control form-control-sm @error('sales_mstr_ship') is-invalid @enderror"
                                    placeholder="Alamat pengiriman" required value="{{ old('sales_mstr_ship') }}">
                                @error('sales_mstr_ship')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="sales_mstr_date"><i class="fas fa-calendar-alt text-primary"></i> Order
                                    Date</label>
                                <div class="input-group date" id="sales_mstr_date_picker" data-target-input="nearest">
                                    <input type="date" name="sales_mstr_date" id="sales_mstr_date"
                                        class="form-control form-control-sm datetimepicker-input @error('sales_mstr_date') is-invalid @enderror"
                                        data-target="#sales_mstr_date_picker" required value="{{ old('sales_mstr_date') }}">
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

                            <div class="form-group col-md-6">
                                <label for="sales_mstr_due_date"><i class="fas fa-calendar-check text-success"></i> Due
                                    Date</label>
                                <div class="input-group date" id="sales_mstr_due_date_picker"
                                    data-target-input="nearest">
                                    <input type="date" name="sales_mstr_due_date" id="sales_mstr_due_date"
                                        class="form-control form-control-sm datetimepicker-input @error('sales_mstr_due_date') is-invalid @enderror"
                                        data-target="#sales_mstr_due_date_picker" required
                                        value="{{ old('sales_mstr_due_date') }}">
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

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-times"></i>
                            Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Sales
                            Order</button>
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
                                <input type="date" name="sales_mstr_due_date" id="efid_Due"
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
        $(document).ready(function() {
            @if ($errors->any())
                $(document).ready(function() {
                    if ($('#modalAddSales').find('.is-invalid').length > 0) {
                        $('#modalAddSales').modal('show');
                    }
                });
            @endif
        });
    </script>
    <script src="{{ asset('js/salesMstr/salesMstrList.js') }}"></script>
    <script src="{{ asset('js/salesMstr/updateModal.js') }}"></script>
@endpush
