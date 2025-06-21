@extends('layouts.app')

@section('title', 'Order Breakdown Detail')

@section('content_header', 'Order Breakdown Detail')

@section('content')
    <div class="card">

        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center">
                <div class="d-flex flex-column mb-2 mb-md-0">
                    <div class="fw-semibold">
                        List Order Breakdown Detail
                    </div>
                </div>
                <x-action-button-header :show-export="true" />

            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover" id="odmmstrlistTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sales Nbr</th>
                            <th>Level</th>
                            <th>Parent Item</th>
                            <th>Desc Parent</th>
                            <th>Child Item</th>
                            <th>Desc Child</th>
                            <th>Qty Per</th>
                            <th>UOM</th>
                            <th>Last Update</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>

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
                                            id="isExactMatch" value="0" onchange="this.value = this.checked ? 1 : 0">
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
    <script src="{{ asset('js/odmMstr/odmMstrList.js') }}"></script>
@endpush
