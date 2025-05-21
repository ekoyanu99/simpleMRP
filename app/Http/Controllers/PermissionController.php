<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    protected $route;

    public function __construct()
    {
        $this->route = 'PermissionMstrList';
    }

    public function data(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action');
        }

        $q = Permission::query()->with('userMstr');

        if ($request->has('fid_Name') && !empty($request->input('fid_Name'))) {
            $q->where('permission_mstr.name', 'LIKE', '%' . $request->input('fid_Name') . '%');
        }

        if ($request->has('fid_Desc') && !empty($request->input('fid_Desc'))) {
            $q->where('permission_mstr.permission_mstr_desc', 'LIKE', '%' . $request->input('fid_Desc') . '%');
        }

        // $permissions = $query->get();

        return DataTables::of($q)
            ->addIndexColumn()
            ->addColumn('user_mstr_name', function ($permission) {
                return $permission->userMstr->user_mstr_name ?? '';
            })
            // update at
            ->addColumn('permission_mstr_ut', function ($permission) {
                return $permission->permission_mstr_ut->diffForHumans();
            })
            ->addColumn('action', 'PermissionMstrListDT')
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        // $permissions = Permission::get();
        return view($this->route);
    }

    public function create()
    {
        return redirect($this->route);
    }

    public function store(Request $request)
    {

        $check = Validator::make($request->all(), [
            'f_Name' => 'required|string|unique:permission_mstr,name',
            'f_Desc' => 'nullable|string',
        ], [
            'f_Name.required' => 'Permission name is required',
            'f_Name.unique' => 'Permission name must be unique',
        ]);

        if ($check->fails()) {

            return redirect()->back()->withErrors($check)->withInput();
        }

        Permission::create([
            'name' => $request->f_Name,
            'permission_mstr_desc' => $request->f_Desc
        ]);

        $message = 'Permission Created Succcesfully';

        return redirect($this->route)->with('status', $message);
    }

    public function edit(Permission $permission)
    {
        return redirect($this->route);
    }

    public function update(Request $request, $permissionId)
    {

        $permission = Permission::findOrFail($permissionId);
        $check = Validator::make($request->all(), [
            'f_Name' => 'required|string|unique:permission_mstr,name,' . $permission->id,
            'f_Desc' => 'nullable|string',
        ], [
            'f_Name.required' => 'Permission name is required',
            'f_Name.unique' => 'Permission name must be unique',
        ]);

        if ($check->fails()) {
            return redirect()->back()->withErrors($check);
        }

        $permission->update([
            'name' => $request->f_Name,
            'permission_mstr_desc' => $request->f_Desc
        ]);

        $message = 'Permission Updated Succesfully';

        return redirect($this->route)->with('status', $message);
    }

    public function destroy($permissionId)
    {
        $permission = Permission::findOrFail($permissionId);
        $permission->delete();

        return redirect($this->route)->with('status', 'Permission Deleted Succesfully');
    }
}
