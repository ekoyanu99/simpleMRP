@extends('layouts.app')

@section('title', 'Bom Master')

@section('content_header', 'Bom Master')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-auto mt-1 ">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddBom">
                        Add New Bom
                    </button>
                </div>
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
                                <select name="bom_mstr_parent" id="bom_mstr_parent" class="form-control form-control-sm"
                                    required="">
                                    <option value="">Select Parent Item</option>
                                    @foreach ($itemmstrs as $itemmstr)
                                        <option value="{{ $itemmstr->item_mstr_id }}">{{ $itemmstr->item_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="bom_mstr_child" class="form-label">
                                    Child Item
                                </label>
                                <select name="bom_mstr_child" id="bom_mstr_child" class="form-control form-control-sm"
                                    required="">
                                    <option value="">Select Child Item</option>
                                    @foreach ($itemmstrs as $itemmstr)
                                        <option value="{{ $itemmstr->item_mstr_id }}">{{ $itemmstr->item_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="bom_mstr_qtyper" class="form-label">
                                    Qty Per
                                </label>
                                <input type="number" name="bom_mstr_qtyper" id="bom_mstr_qtyper"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ old('bom_mstr_qtyper') }}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="bom_mstr_start" class="form-label">
                                    Qty Per
                                </label>
                                <input type="date" name="bom_mstr_start" id="bom_mstr_start"
                                    class="form-control form-control-sm" value="{{ old('bom_mstr_start') }}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="bom_mstr_expire" class="form-label">
                                    Qty Per
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
@stop

@push('styles')
@endpush

@push('scripts')
    <script src="{{ asset('js/bomMstr/bomMstrList.js') }}"></script>
    <script src="{{ asset('js/bomMstr/updateModal.js') }}"></script>
@endpush
