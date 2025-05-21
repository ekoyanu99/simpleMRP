@extends('layouts.app')

@section('title', 'MRP')

@section('content_header', 'MRP')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center">
                <div class="d-flex flex-column mb-2 mb-md-0">
                    <div class="fw-semibold">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalMrpRun">
                            <i class="fas fa-sync-alt me-1"></i> Generate MRP
                        </button>
                    </div>
                </div>
                <x-action-button-header :show-export="true" />

            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover" id="mrpmstrlistTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Item</th>
                            <th>Item Desc</th>
                            <th>Stock</th>
                            <th>Outstanding</th>
                            <th>Summary</th>
                            <th>Uom</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>

            </div>

        </div>
    </div>

    <form action="{{ route('MrpMstr.generateMrp') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal fade" id="modalMrpRun" tabindex="-1" role="dialog" aria-labelledby="modalMrpRunTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Generate MRP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">

                        <h4 class="text-danger font-weight-bold">Are you sure you want to generate MRP based on the current
                            data?</h4>

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

                                <x-adminlte-input id="f_item_name" name="f_item_name" label="Item Name"
                                    placeholder="Search by Name" fgroup-class="col-md-6" />

                                <x-adminlte-input id="f_item_desc" name="f_item_desc" label="Description"
                                    placeholder="Search by Description" fgroup-class="col-md-6" />

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
    <script src="{{ asset('js/mrpMstr/mrpMstrList.js') }}"></script>
    <script src="{{ asset('js/mrpMstr/updateModal.js') }}"></script>
@endpush
