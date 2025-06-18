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

        $q = Permission::query();

        if ($request->has('fid_Name') && !empty($request->input('fid_Name'))) {
            $q->where('permissions.name', 'LIKE', '%' . $request->input('fid_Name') . '%');
        }

        return DataTables::of($q)
            ->addIndexColumn()
            // update at
            ->addColumn('updated_at', function ($permission) {
                return $permission->updated_at ? $permission->updated_at->diffForHumans() : '-';
            })
            ->addColumn('action', 'permission.datatable')
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        return view('permission.index');
    }

    public function create()
    {
        return redirect($this->route);
    }

    public function store(Request $request)
    {

        $check = Validator::make($request->all(), [
            'f_Name' => 'required|string|unique:permissions,name',
        ], [
            'f_Name.required' => 'Permission name is required',
            'f_Name.unique' => 'Permission name must be unique',
        ]);

        if ($check->fails()) {

            return redirect()->back()->withErrors($check)->withInput();
        }

        Permission::create([
            'name' => $request->f_Name,
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
            'f_Name' => 'required|string|unique:permissions,name,' . $permission->id,
        ], [
            'f_Name.required' => 'Permission name is required',
            'f_Name.unique' => 'Permission name must be unique',
        ]);

        if ($check->fails()) {
            return redirect()->back()->withErrors($check);
        }

        $permission->update([
            'name' => $request->f_Name,
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
