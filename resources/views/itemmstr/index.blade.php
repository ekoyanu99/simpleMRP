@extends('layouts.app')

@section('title', 'Item Master')

@section('content_header', 'Item Master')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-auto mt-1 ">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddItem">
                        Add Item
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover" id="itemmstrlistTable">
                    <thead>
                        <tr>
                            <th>Item Code</th>
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
                                <select name="item_pmcode" id="item_pmcode" class="form-control form-control-sm"
                                    required="">
                                    <option value="P">Purchase</option>
                                    <option value="M">Manufacture</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="item_prod_line" class="form-label">
                                    Production Line
                                </label>
                                <select name="item_prod_line" id="item_prod_line" class="form-control form-control-sm"
                                    required="">
                                    <option value="">Select Production Line</option>
                                    <option value="SUP">Supporting Material</option>
                                    <option value="WIP">WIP</option>
                                    <option value="FG">Finish Good</option>
                                </select>
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
                                <select name="item_uom" id="item_uom" class="form-control form-control-sm" required="">
                                    <option value="">Select Satuan</option>
                                    <option value="gram">Gram</option>
                                    <option value="ml">Mililiter</option>
                                    <option value="pcs">Pieces</option>
                                </select>
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
@stop

@push('styles')
@endpush

@push('scripts')
    <script src="{{ asset('js/itemMstr/itemMstrList.js') }}"></script>
    <script src="{{ asset('js/itemMstr/updateModal.js') }}"></script>
@endpush
