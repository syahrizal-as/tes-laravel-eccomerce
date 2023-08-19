<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            $data = Role::query();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('permission', function ($data) {
                    return $data->getPermissionNames()->map(function ($per) {
                        return '<button class="btn btn-sm btn-success mb-1 mt-1 mr-1">'.$per.'</button>';
                    })->implode(' ');
                })
                ->addColumn('action', function ($row) {

                    if (auth()->user()->can('roles.edit')) {
                        $btn = '<a href="'.route('admin.role.edit', $row->id).'" data-toggle="tooltip"  data-original-title="Edit" class="edit btn btn-primary btn-sm editRole">Edit</a>';
                    } else {
                        $btn = '';
                    }

                    if (auth()->user()->can('roles.delete')) {
                        $btn = $btn.' <a href="javascript:void(0)"  onClick="Delete(this.id)" data-toggle="tooltip"  id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteRole">Delete</a>';
                    } else {
                        $btn = $btn.'';
                    }
                    //

                    return '<div class="d-inline-block text-nowrap">'.$btn.'</div>';

                })
                ->rawColumns(['action', 'permission'])
                ->make(true);
        }

        return view('pages.admin.role.index');
    }

    public function create()
    {
        $permissions = Permission::latest()->get();

        return view('pages.admin.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles',
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
        ]);

        //assign permission to role
        $role->syncPermissions($request->input('permissions'));

        if ($role) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.role.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.role.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name')->get();

        return view('pages.admin.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$role->id,
        ]);

        $role = Role::findOrFail($role->id);
        $role->update([
            'name' => $request->input('name'),
        ]);

        //assign permission to role
        $role->syncPermissions($request->input('permissions'));

        if ($role) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.role.index')->with(['success' => 'data berhasil disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.role.index')->with(['error' => 'data gagal disimpan!']);
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $permissions = $role->permissions;
        $role->revokePermissionTo($permissions);
        $role->delete();

        if ($role) {

            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
            ]);
        }
    }
}
