<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    //
    protected $route;

    public function __construct()
    {
        $this->route = 'RoleMstrList';
    }

    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete'), only: ['destroy']),
    //     ];
    // }

    public function index()
    {
        return view('role.index');
    }

    public function data(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action');
        }

        $q = Role::query()->with('permissions');

        if ($request->has('fid_Name') && !empty($request->input('fid_Name'))) {
            $q->where('roles.name', 'LIKE', '%' . $request->input('fid_Name') . '%');
        }

        return DataTables::of($q)
            ->addIndexColumn()
            // update at
            ->editColumn('updated_at', function ($role) {
                return $role->updated_at->diffForHumans();
            })
            ->addColumn('permissions', function ($role) {
                return $role->permissions->pluck('name')->implode(', ');
            })
            ->addColumn('action', 'role.datatable')
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return redirect($this->route);
    }

    public function store(Request $request)
    {

        $check = Validator::make($request->all(), [
            'f_Name' => 'required|string|unique:roles,name',
        ], [
            'f_Name.required' => 'Role name is required',
            'f_Name.unique' => 'Role name already exists',
        ]);

        if ($check->fails()) {
            return redirect()->back()->withErrors($check)->withInput();
        }

        Role::create([
            'name' => $request->f_Name,
        ]);

        $message = 'Role Created Succcesfully';

        return redirect($this->route)->with('status', $message);
    }

    public function show(Role $role)
    {
        redirect($this->route);
    }

    public function edit(Role $role)
    {
        redirect($this->route);
    }

    public function update(Request $request, $roleId)
    {

        $role = Role::findOrFail($roleId);
        $check = Validator::make($request->all(), [
            'f_Name' => 'required|string|unique:roles,name,' . $role->id,
        ], [
            'f_Name.required' => 'Role name is required',
            'f_Name.unique' => 'Role name already exists',
        ]);

        if ($check->fails()) {
            return redirect($this->route)->withErrors($check)->withInput();
        }

        $role->update([
            'name' => $request->f_Name,
        ]);

        $message = 'Role Updated Succcesfully';

        return redirect()->back()->with('status', $message);
    }

    public function destroy($roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->delete();
        $message = 'Role Deleted Succcesfully';

        return redirect($this->route)->with('status', $message);
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $role->id)->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')->all();
        $users = User::role($role->name)->get();

        return view('role.edit', compact('role', 'permissions', 'rolePermissions', 'users'));
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'f_Permission' => 'required',
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->f_Permission);

        $message = 'Permission added to role ';

        return redirect()->back()->with('status', $message);
    }
}
