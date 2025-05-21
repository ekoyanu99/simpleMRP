@extends('layouts.app')

@section('title', 'Inventory Detail')

@section('content_header', 'Inventory Detail')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center">
                <div class="d-flex flex-column mb-2 mb-md-0">
                    <div class="fw-semibold">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddIn">
                            <i class="fas fa-plus-circle me-1"></i> Add Stock
                        </button>
                    </div>
                </div>
                <x-action-button-header :show-export="true" />

            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover" id="indetlistTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item</th>
                            <th>Item Desc</th>
                            <th>Location</th>
                            <th>Quantity</th>
                            <th>Uom</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>

            </div>

        </div>
    </div>

    <form action="{{ route('InDets.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal fade" id="modalAddIn" tabindex="-1" role="dialog" aria-labelledby="modalAddInTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row mb-4">

                            <div class="form-group col-md-6">
                                <label for="in_det_item" class="form-label">
                                    Item
                                </label>
                                <x-adminlte-select2 name="in_det_item" id="in_det_item" onchange="getDesc()"
                                    data-dropdown-parent="#modalAddIn">
                                    <option value="">Select an item</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                                    @endforeach
                                </x-adminlte-select2>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="in_det_itemdesc" class="form-label">
                                    Description
                                </label>
                                <input type="text" name="in_det_itemdesc" id="in_det_itemdesc"
                                    class="form-control form-control-sm" readonly required=""
                                    value="{{ old('in_det_itemdesc') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="in_det_qty" class="form-label">
                                    Qty
                                </label>
                                <input type="number" name="in_det_qty" id="in_det_qty" class="form-control form-control-sm"
                                    required="" value="{{ old('in_det_qty') }}">
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
                        <h5 class="modal-title" id="editModalLabel">Edit</h5>
                        <button type="button" class="btn btn-sm btn-close" data-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="efid_Item" class="form-label">Item</label>
                                <input type="text" name="efid_Item" id="efid_Item"
                                    class="form-control form-control-sm w-100" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="efid_ItemDesc" class="form-label">Item Desc</label>
                                <input type="text" name="efid_ItemDesc" id="efid_ItemDesc"
                                    class="form-control form-control-sm w-100" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="efid_Qty" class="form-label">Qty</label>
                                <input type="text" name="efid_Qty" id="efid_Qty"
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

                                <x-adminlte-input id="f_in_det_loc" name="f_in_det_loc" label="Location"
                                    placeholder="Search by Location" fgroup-class="col-md-6" />
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
    <script>
        getDesc = () => {
            let item_id = document.getElementById('in_det_item').value;
            console.log(item_id);
            let url = "{{ url('GetDesc') }}/" + item_id;
            console.log(url);
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('in_det_itemdesc').value = data.item_desc;
                });
        }
    </script>
    <script src="{{ asset('js/inDet/inDetList.js') }}"></script>
    <script src="{{ asset('js/inDet/updateModal.js') }}"></script>
@endpush
