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
                                    data-target="#modalAddUser">
                                    <i class="fas fa-plus-circle me-1"></i> Add User
                                </button>
                            </div>
                        </div>
                        <x-action-button-header />

                    </div>
                </div>

                <div class="card-body">

                    <table class="table table-sm table-bordered table-striped table-hover" id="UserMstrListTable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>ROLE</th>
                                <th>CREATED AT</th>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFilterLabel">Filter</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form id="addFilterForm" action="" method="post" autocomplete="off"
                    onkeydown="return event.key != 'Enter'">
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="fid_Name" class="form-label">Name</label>
                                <input type="text" id="fid_Name" class="form-control form-control-sm"
                                    placeholder="Search by Name">
                            </div>
                            <div class="col-md-6">
                                <label for="fid_Email" class="form-label">Email</label>
                                <input type="text" id="fid_Email" class="form-control form-control-sm"
                                    placeholder="Search by Email">
                            </div>
                            <div class="col-md-6">
                                <label for="fid_Nik" class="form-label">Nik</label>
                                <input type="text" id="fid_Nik" class="form-control form-control-sm"
                                    placeholder="Search by Nik">
                            </div>
                        </div>
                        <p class="text-modal">Click the filter button to start searching</p>
                    </div>
                    <div class="modal-footer">

                        <x-action-button-filter />

                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- modal Add User --}}
    <form action="{{ route('UserMstrs.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="modalAddUserTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row mb-2 mt-2">
                            <div class="col-md-12">
                                <label for="f_Roles[]" class="form-label">
                                    Roles
                                </label>
                                <select name="f_Roles" id="IdRoles" class="form-control form-control-sm"
                                    style="width: 100%">
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ $role == 'user' ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2 mt-2">
                            <div class="col-md-4">
                                <label for="f_Name" class="form-label">
                                    Name
                                </label>
                                <input type="text" name="f_Name" id="Id_Name"
                                    class="form-control form-control-sm w-100" placeholder="Masukkan Nama" required="">
                            </div>
                            <div class="col-md-4">
                                <label for="f_Email" class="form-label">
                                    Email
                                </label>
                                <input type="text" name="f_Email" id="Id_Email" class="form-control form-control-sm"
                                    placeholder="Masukkan Email" required="">
                            </div>
                            <div class="col-md-4">
                                <label for="f_Password" class="form-label">
                                    Password
                                </label>
                                <input type="text" name="f_Password" id="Id_Password"
                                    class="form-control form-control-sm" placeholder="" required="">
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                        <h5 class="modal-title" id="editModalLabel">Edit Role</h5>
                        <button type="button" class="btn btn-small btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="modalName" class="form-label">Role Name</label>
                                <input type="text" name="f_Name" id="modalName" class="{!! Config('app.inputForm') !!}"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="modalDesc" class="form-label">Role Description</label>
                                <input type="text" name="f_Desc" id="modalDesc" class="{!! Config('app.inputForm') !!}"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
    <script src="{{ asset('js/userMstr/userMstrList.js') }}"></script>
    <script src="{{ asset('js/userMstr/updateModal.js') }}"></script>
@endpush
