@extends('layouts.app')

@section('title', 'Inventory Detail')

@section('content_header', 'Inventory Detail')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-auto mt-1 ">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddIn">
                        Add Stock
                    </button>
                </div>
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

                                <select name="in_det_item" id="in_det_item" class="form-control form-control-sm" required
                                    onchange="getDesc()">
                                    <option value="">Select Item</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->item_mstr_id }}">{{ $item->item_name }}</option>
                                    @endforeach
                                </select>
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
