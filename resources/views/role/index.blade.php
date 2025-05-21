@extends('layouts.app')

@section('title', 'Role Master')

@section('content_header', 'Role Master')

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="card">

                <div class="card-header">
                    <div
                        class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center">
                        <div class="d-flex flex-column mb-2 mb-md-0">
                            <div class="fw-semibold">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#modalAddRole">
                                    <i class="fas fa-plus-circle me-1"></i> Add Role
                                </button>
                            </div>
                        </div>
                        <x-action-button-header :show-export="false" />

                    </div>
                </div>

                <div class="card-body">

                    <table class="table table-sm table-bordered table-striped table-hover" id="RoleMstrListTable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ROLE NAME</th>
                                <th>LIST OF PERMISSION</th>
                                <th>LATEST UPDATE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>


    <div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="modalFilterLabel"
        aria-hidden="true">
        <form id="addFilterForm" action="" method="post" autocomplete="off" onkeydown="return event.key != 'Enter'">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header"
                        style="background-color: #222149; color: white; border-bottom: 1px solid #dee2e6;">
                        <h5 class="modal-title" id="modalFilterLabel">Filter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="color: white; font-size: 1.5rem; border: none; background: transparent;">
                            &times;
                        </button>
                    </div>


                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="fid_Name" class="form-label">Role Name</label>
                                <input type="text" id="fid_Name" class="form-control form-control-sm"
                                    placeholder="Search by Role Name">
                            </div>
                        </div>
                        <p class="text-modal">Click the filter button to start searching</p>
                    </div>
                    <div class="modal-footer"
                        style="background-color: #f8f9fa; color: #212529; border-top: solid 1px #ece0ea;">

                        <x-action-button-filter :show-export="false" />

                    </div>
                </div>
            </div>
        </form>
    </div>


    {{-- modal add Role --}}
    <form action="{{ route('RoleMstrs.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal fade" id="modalAddRole" tabindex="-1" role="dialog" aria-labelledby="modalAddRoleTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="IdName" class="form-label">
                                    Role Name
                                </label>
                                <input type="text" name="f_Name" id="IdName" class="form-control form-control-sm"
                                    placeholder="Masukkan Nama Role" required="" value="{{ old('f_Name') }}">
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
                <form id="editForm" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Role</h5>
                        <button type="button" class="btn btn-small btn-close" data-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="modalName" class="form-label">Role Name</label>
                                <input type="text" name="f_Name" id="modalName" class="form-control form-control-sm"
                                    required>
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
    <script src="{{ asset('js/roleMstr/roleMstrList.js') }}"></script>
    <script src="{{ asset('js/roleMstr/updateModal.js') }}"></script>
@endpush
