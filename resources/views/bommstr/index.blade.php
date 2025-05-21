@extends('layouts.app')

@section('title', 'Bom Master')

@section('content_header', 'Bom Master')

@section('content')
    <div class="card">

        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center">
                <div class="d-flex flex-column mb-2 mb-md-0">
                    <div class="fw-semibold">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddBom">
                            <i class="fas fa-plus-circle me-1"></i> Add New Bom
                        </button>
                    </div>
                </div>
                <x-action-button-header :show-export="true" />

            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover" id="bommstrlistTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Parent Item</th>
                            <th>Desc Parent</th>
                            <th>Child Item</th>
                            <th>Desc Child</th>
                            <th>Qty Per</th>
                            <th>UOM</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>

            </div>

        </div>
    </div>

    <form action="{{ route('BomMstrs.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal fade" id="modalAddBom" tabindex="-1" role="dialog" aria-labelledby="modalAddBomTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Bom</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row mb-4">

                            <div class="form-group col-md-6">
                                <label for="bom_mstr_parent" class="form-label">
                                    Parent Item
                                </label>

                                <x-adminlte-select2 name="bom_mstr_parent" id="bom_mstr_parent" required="">
                                    <option value="">Select Parent Item</option>
                                    @foreach ($itemmstrs as $itemmstr)
                                        <option value="{{ $itemmstr->item_id }}">{{ $itemmstr->item_name }}</option>
                                    @endforeach
                                </x-adminlte-select2>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="bom_mstr_child" class="form-label">
                                    Child Item
                                </label>


                                <x-adminlte-select2 name="bom_mstr_child" id="bom_mstr_child" required="">
                                    <option value="">Select Child Item</option>
                                    @foreach ($itemmstrs as $itemmstr)
                                        <option value="{{ $itemmstr->item_id }}">{{ $itemmstr->item_name }}</option>
                                    @endforeach
                                </x-adminlte-select2>

                            </div>

                            <div class="form-group col-md-4">
                                <label for="bom_mstr_qtyper" class="form-label">
                                    Qty Per
                                </label>
                                <input type="text" name="bom_mstr_qtyper" id="bom_mstr_qtyper"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ old('bom_mstr_qtyper') }}" pattern="^\d+(\.\d{1,3})?$"
                                    title="Please enter a valid quantity">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="bom_mstr_start" class="form-label">
                                    Start
                                </label>
                                <input type="date" name="bom_mstr_start" id="bom_mstr_start"
                                    class="form-control form-control-sm" value="{{ old('bom_mstr_start') }}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="bom_mstr_expire" class="form-label">
                                    Expire
                                </label>
                                <input type="date" name="bom_mstr_expire" id="bom_mstr_expire"
                                    class="form-control form-control-sm" value="{{ old('bom_mstr_expire') }}">
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

                                <x-adminlte-input id="f_item_parent_name" name="f_item_parent_name" label="Parent Name"
                                    placeholder="Search by Parent Name" fgroup-class="col-md-6" />

                                <x-adminlte-input id="f_item_parent_desc" name="f_item_parent_desc" label="Parent Desc"
                                    placeholder="Search by Parent Desc" fgroup-class="col-md-6" />

                                <x-adminlte-input id="f_item_child_name" name="f_item_child_name" label="Child Name"
                                    placeholder="Search by Child Name" fgroup-class="col-md-6" />

                                <x-adminlte-input id="f_item_child_desc" name="f_item_child_desc" label="Child Desc"
                                    placeholder="Search by Child Desc" fgroup-class="col-md-6" />

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

    <x-modal-export />
@stop

@push('styles')
@endpush

@push('scripts')
    <script src="{{ asset('js/bomMstr/bomMstrList.js') }}"></script>
    <script src="{{ asset('js/bomMstr/updateModal.js') }}"></script>
@endpush
