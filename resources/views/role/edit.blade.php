@extends('layouts.app')

@section('title', 'Give Permission')

@section('content_header', 'Give Permission')

@section('content')

    @php
        $groupedPermissions = [];

        foreach ($permissions as $perm) {
            $parts = explode('.', $perm->name);
            if (count($parts) >= 3) {
                [$menu, $submenu, $action] = $parts;
                $groupedPermissions[$menu][$submenu][] = $perm;
            }
        }
    @endphp

    @if (session('status'))
        <x-adminlte-alert theme="info" icon="fas fa-check-circle" dismissable title="Success!">
            {{ session('status') }}
        </x-adminlte-alert>
    @endif

    <form class="form form-sm" action="{{ url('RoleMstr/' . $role->id . '/give-permission') }}" method="POST"
        autocomplete="off">
        @csrf
        @method('PUT')
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <a href="{{ url('RoleMstrList') }}" class="btn btn-secondary btn-small">
                        <i class="fas fa-arrow-left" style="font-size: 12px;"></i> Back
                    </a>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-small">
                        <i class="fas fa-save" style="font-size: 12px;"></i> Simpan
                    </button>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-info text-white fw-bold">
                    <i class="fa fa-info-circle me-2"></i>List of Users With Role <span
                        class="text-muted">{{ $role->name }}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($users as $user)
                            <div class="col-auto mb-3">
                                <div class="card shadow-sm">
                                    <div class="chat card-body p-0">
                                        <div class="chat-header d-flex align-items-center p-3">
                                            <img src="{{ $user->image && file_exists(storage_path('app/private/public/image/' . $user->image))
                                                ? url('storage/app/private/public/image/' . $user->image)
                                                : url('/images/avatar.png') }}"
                                                class="rounded-circle me-4" width="60" height="60"
                                                alt="{{ $user->image ? 'User Image' : 'Default Avatar' }}" />

                                            <div class="flex-grow-1">
                                                <div class="chat-about">
                                                    <h5 class="chat-with mb-1 fw-bold">
                                                        {{ $user->name }}
                                                    </h5>
                                                    <div class="chat-num-messages text-muted small">
                                                        <i class="fas fa-envelope me-1"></i>
                                                        {{ $user->email }}
                                                    </div>
                                                    <span class="badge bg-success mt-1">
                                                        <i class="fas fa-circle me-1 small"></i> Active
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fa fa-list me-2"></i>Role <span class="text-muted">{{ $role->name }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover align-middle text-nowrap"
                            id="RoleDetListTable">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Submenu</th>
                                    <th>Permission</th>
                                    <th>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="checkbox" id="select-all-global"> Select All
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupedPermissions as $menu => $submenus)
                                    @foreach ($submenus as $submenu => $permList)
                                        <tr>
                                            <td><strong>{{ ucfirst($menu) }}</strong></td>
                                            <td>{{ ucfirst($submenu) }}</td>
                                            <td>
                                                @foreach ($permList as $perm)
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox"
                                                                class="form-check-input group-{{ $menu }}-{{ $submenu }}"
                                                                name="f_Permission[]" value="{{ $perm->name }}"
                                                                {{ in_array($perm->id, $rolePermissions) ? 'checked' : '' }}>
                                                            {{ str_replace($menu . '.' . $submenu . '.', '', $perm->name) }}
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td class="item-align-center">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input select-all-submenu"
                                                            data-group="{{ $menu }}-{{ $submenu }}">
                                                        &nbsp;
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </form>

@stop

@push('styles')
@endpush

@push('scripts')
    <script src="{{ url('resources/js/index.js') }}"></script>
    <script>
        initDtClient("RoleDetListTable");
    </script>
    <script>
        document.querySelectorAll('.select-all-submenu').forEach(el => {
            el.addEventListener('change', function() {
                const group = this.dataset.group;
                const checkboxes = document.querySelectorAll('.group-' + group);
                checkboxes.forEach(cb => cb.checked = this.checked);
            });
        });

        document.getElementById('select-all-global').addEventListener('change', function() {
            const allCheckboxes = document.querySelectorAll('input[type="checkbox"]:not(#select-all-global)');
            allCheckboxes.forEach(cb => cb.checked = this.checked);
        });
    </script>
@endpush
