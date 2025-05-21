<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $route;

    public function __construct()
    {
        $this->route = 'UserMstrList';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('user.index', compact('roles'));
    }

    public function data(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action');
        }

        // Query with eager loading
        $users = User::query();

        // Apply filters
        if ($request->has('fid_Name') && !empty($request->input('fid_Name'))) {
            $users->where('name', 'LIKE', '%' . $request->input('fid_Name') . '%');
        }

        if ($request->has('fid_Email') && !empty($request->input('fid_Email'))) {
            $users->where('email', 'LIKE', '%' . $request->input('fid_Email') . '%');
        }

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', 'user.datatable')
            ->addColumn('role', function ($user) {
                return $user->roles->pluck('name')->implode(', ');
            })
            ->editColumn('created_at', function ($user) {
                return formatWaktuHuman($user->created_at);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        redirect($this->route);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'f_Name' => 'required|string|max:255',
            'f_Email' => 'required|email|max:255|unique:users,email',
            'f_Password' => 'required|string|min:8|max:20',
            'f_Roles' => 'required',
        ]);

        $cb = Auth::user()->id;
        $user = User::create([
            'name' => $request->f_Name,
            'email' => $request->f_Email,
            'password' => Hash::make($request->f_Password),
        ]);

        $user->syncRoles($request->f_Roles);

        return redirect($this->route)->with('status', 'User and Relations Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        $user = User::findOrFail($userId);
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('User.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('User.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userId)
    {

        $user = User::findOrFail($userId);
        $request->validate([
            'f_Name' => 'required|string|max:255',
            'f_Password' => 'nullable|string|min:8|max:20',
            'f_Roles' => 'nullable',
        ]);

        $data = [
            'name' => $request->f_Name,
            'email' => $request->f_Email,
        ];

        if (!empty($request->f_Password)) {
            $data['password'] = Hash::make($request->f_Password);
        }

        $user->update($data);

        if ($request->f_Roles) {
            $user->syncRoles($request->f_Roles);
        }

        // end user_info
        $message = 'Data user ' . $request->f_Name . ' updated successfully';

        return redirect()->back()->with('status', 'User and Relations Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect($this->route)->with('status', 'User Deleted Succcesfully with Roles');
    }
}
