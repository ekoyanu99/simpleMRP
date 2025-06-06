@extends('layouts.app')

@section('title', 'Item Master')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center">
        <h1 class="m-0 mb-2 mb-md-0">
            <i class="fas fa-boxes"></i> Item Master
        </h1>
    </div>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center">
                <div class="d-flex flex-column mb-2 mb-md-0">
                    <div class="fw-semibold">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddItem">
                            <i class="fas fa-plus-circle me-1"></i> Add Item
                        </button>
                    </div>
                </div>
                <x-action-button-header :show-export="true" />

            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover" id="itemmstrlistTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>PM Code</th>
                            <th>Production Line</th>
                            <th>Reject Rate</th>
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

    <form action="{{ route('ItemMstrs.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal fade" id="modalAddItem" tabindex="-1" role="dialog" aria-labelledby="modalAddItemTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="item_name" class="form-label">
                                    Item Name
                                </label>
                                <input type="text" name="item_name" id="item_name" class="form-control form-control-sm"
                                    placeholder="" required="" value="{{ old('item_name') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="item_desc" class="form-label">
                                    Description
                                </label>
                                <input type="text" name="item_desc" id="item_desc" class="form-control form-control-sm"
                                    placeholder="" required="" value="{{ old('item_desc') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="item_pmcode" class="form-label">
                                    Purchase or Manufacture
                                </label>
                                <x-adminlte-select2 name="item_pmcode" id="item_pmcode"
                                    data-dropdown-parent="#modalAddItem">
                                    <option value="P">Purchase</option>
                                    <option value="M">Manufacture</option>
                                </x-adminlte-select2>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="item_prod_line" class="form-label">
                                    Production Line
                                </label>
                                <x-adminlte-select2 name="item_prod_line" id="item_prod_line" required
                                    data-dropdown-parent="#modalAddItem">
                                    <option value="">Select Production Line</option>
                                    <option value="SUP">Supporting Material</option>
                                    <option value="WIP">WIP</option>
                                    <option value="FG">Finish Good</option>
                                </x-adminlte-select2>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="item_rjrate" class="form-label">
                                    Reject Rate
                                </label>
                                <input type="number" name="item_rjrate" id="item_rjrate"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ old('item_rjrate') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="item_uom" class="form-label">
                                    Uom
                                </label>
                                <x-adminlte-select2 name="item_uom" id="item_uom" data-dropdown-parent="#modalAddItem"
                                    required>
                                    <option value="">Select Satuan</option>
                                    <option value="gram">Gram</option>
                                    <option value="ml">Mililiter</option>
                                    <option value="pcs">Pieces</option>
                                </x-adminlte-select2>
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
                        <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                        <button type="button" class="btn btn-sm btn-close" data-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="efid_Desc" class="form-label">Item Description</label>
                                <input type="text" name="efid_Desc" id="efid_Desc"
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

                                <x-adminlte-input id="f_item_name" name="f_item_name" label="Item Name"
                                    placeholder="Search by Name" fgroup-class="col-md-6" />

                                <x-adminlte-input id="f_item_desc" name="f_item_desc" label="Description"
                                    placeholder="Search by Description" fgroup-class="col-md-6" />

                                <x-adminlte-input id="f_item_pmcode" name="f_item_pmcode" label="PM Code"
                                    placeholder="Search by PM Code" fgroup-class="col-md-6" />

                                <x-adminlte-input id="f_item_prod_line" name="f_item_prod_line" label="Production Line"
                                    placeholder="Search by Prod Line" fgroup-class="col-md-6" />

                                <x-adminlte-input id="f_item_rjrate" name="f_item_rjrate" label="Reject Rate"
                                    placeholder="Search by Reject Rate" fgroup-class="col-md-6" />

                                <x-adminlte-input id="f_item_uom" name="f_item_uom" label="Uom"
                                    placeholder="Search by Uom" fgroup-class="col-md-6" />


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
    <script src="{{ asset('js/itemMstr/itemMstrList.js') }}"></script>
    <script src="{{ asset('js/itemMstr/updateModal.js') }}"></script>
@endpush
