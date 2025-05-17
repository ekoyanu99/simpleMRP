@extends('layouts.app')

@section('title', 'MRP')

@section('content_header', 'MRP')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-auto mt-1 ">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalMrpRun">
                        Generate MRP
                    </button>
                </div>
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
@stop

@push('styles')
@endpush

@push('scripts')
    <script src="{{ asset('js/mrpMstr/mrpMstrList.js') }}"></script>
    <script src="{{ asset('js/mrpMstr/updateModal.js') }}"></script>
@endpush
