<x-app-layout>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="header" style="background-color: #dd407c; color:white !important;">
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-smal btn-info" data-bs-toggle="modal"
                            data-bs-target="#modalAddPermission">
                            <i class="fa-solid fa-plus me-1" style="font-size: 12px;"></i>
                            Add Permission
                        </button>

                        <x-action-button-header :show-migrate="false" />

                    </div>
                </div>

                <div class="card-body">

                    <table class="table table-sm table-bordered table-striped table-hover" id="PermissionMstrListTable">
                        <thead>
                            <tr>
                                <th style="width: 10%">NO</th>
                                <th style="width: 15%">PERMISSION NAME</th>
                                <th>DESCRIPTION</th>
                                <th style="width: 15%">CREATED BY</th>
                                <th style="width: 16%">LATEST UPDATE</th>
                                <th style="width: 6%">ACTION</th>
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
        <form id="addFilterForm" action="" method="post" autocomplete="off"
            onkeydown="return event.key != 'Enter'">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header"
                        style="background-color: #222149; color: white; border-bottom: 1px solid #dee2e6;">
                        <h5 class="modal-title" id="modalFilterLabel">Filter</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                            style="color: white; font-size: 1.5rem; border: none; background: transparent;">
                            &times;
                        </button>
                    </div>


                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="fid_Name" class="form-label">Nama</label>
                                <input type="text" id="fid_Name" class="form-control form-control-sm"
                                    placeholder="Search by Name">
                            </div>
                            <div class="col-md-6">
                                <label for="fid_Desc" class="form-label">Description</label>
                                <input type="text" id="fid_Desc" class="form-control form-control-sm"
                                    placeholder="Search by Description">
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


    {{-- modal add Permission --}}
    <form action="{{ route('PermissionMstrs.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal fade" id="modalAddPermission" tabindex="-1" role="dialog"
            aria-labelledby="modalAddPermissionTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Permission</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="IdName" class="form-label">
                                    Permission Name
                                </label>
                                <input type="text" name="f_Name" id="IdName" class="{!! Config('app.inputForm') !!}"
                                    placeholder="Masukkan Nama Permission" required="" value="{{ old('f_Name') }}">
                            </div>
                            <div class="col-md-12">
                                <label for="IdDesc" class="form-label">
                                    Description
                                </label>
                                <input type="text" name="f_Desc" id="IdDesc" class="{!! Config('app.inputForm') !!}"
                                    placeholder="Deskripsi Permission" value="{{ old('f_Desc') }}">
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
                <form id="editForm" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Permission</h5>
                        <button type="button" class="btn btn-small btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="modalName" class="form-label">Permission Name</label>
                                <input type="text" name="f_Name" id="modalName" class="{!! Config('app.inputForm') !!}"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="modalDesc" class="form-label">Permission Description</label>
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



    @push('scripts')
        <script src="{{ 'resources/js/permissionMstr/getData.js' }}"></script>
        <script src="{{ 'resources/js/permissionMstr/updateModal.js' }}"></script>
    @endpush

</x-app-layout>
