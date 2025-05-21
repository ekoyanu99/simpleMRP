@extends('layouts.app')

@section('title', 'Edit User')

@section('content_header', 'Edit User')

@section('content')

    <div class="card">
        <div class="card-body">
            <form class="form" action="{{ route('UserMstrs.update', $user->id) }}" method="POST" autocomplete="off"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    {{-- section form user_mstr --}}
                    <div class="col-md-6 col-sm-12 mb-2">
                        <div class="">
                            <div class="">
                                <label for="Id_Name" class="form-label">
                                    Name
                                </label>
                                <input type="text" name="f_Name" id="Id_Name"
                                    class="form-control form-control-sm w-100" placeholder="" required=""
                                    value="{{ $user->name }}">
                            </div>

                            <div class="">
                                <label for="Id_Email" class="form-label">
                                    Email
                                </label>
                                <input type="text" name="f_Email" id="Id_Email"
                                    class="form-control form-control-sm w-100" placeholder="" readonly
                                    value="{{ $user->email }}">
                            </div>

                            <div class="">
                                <label for="Id_Password" class="form-label">
                                    Password
                                </label>
                                <input type="text" name="f_Password" id="Id_Password"
                                    class="form-control form-control-sm w-100" placeholder="">
                                @error('f_Password')
                                    <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            @role('superadmin')
                                <div class="">
                                    <label for="IdRoles" class="form-label">
                                        Roles
                                    </label>
                                    <select name="f_Roles[]" id="IdRoles" class="form-control selectpicker"
                                        data-live-search="true" title="Select role">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}"
                                                {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endrole
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-sm-6">
                        <button type="submit" class="btn btn-primary btn-small">
                            <i class="fas fa-save"></i> Update
                        </button>

                        <a href="{{ url('UserMstrList') }}" class="btn btn-small btn-dark">
                            &laquo; Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop

@push('styles')
@endpush

@push('scripts')
@endpush
