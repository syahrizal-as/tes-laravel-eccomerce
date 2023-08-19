<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aqiqah;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            $data = User::query()->latest();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($data) {
                    return $data->getRoleNames()->map(function ($role) {
                        return ' <label class="badge bg-success">' . $role . '</label>';
                    })->implode(' ');
                })
                ->addColumn('action', function ($row) {

                    if (auth()->user()->can('roles.edit')) {
                        $btn = '<a href="' . route('admin.user.edit', $row->id) . '" data-toggle="tooltip"  data-original-title="Edit" class="edit btn btn-primary btn-sm editRole">Edit</a>';
                    } else {
                        $btn = '';
                    }

                    if (auth()->user()->can('roles.delete')) {
                        $btn = $btn . ' <a href="javascript:void(0)"  onClick="Delete(this.id)" data-toggle="tooltip"  id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteRole">Delete</a>';
                    } else {
                        $btn = $btn . '';
                    }
                    //

                    return $btn;
                })
                ->rawColumns(['action', 'role'])
                ->make(true);
        }

        return view('pages.admin.user.index');
    }

    public function create()
    {
        $roles = Role::latest()->get();

        return view('pages.admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',

        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            //assign role
            $user->assignRole($request->input('role'));
            DB::commit();
            if ($user) {
                //redirect dengan pesan sukses
                return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Disimpan!']);
            }
            return redirect()->route('admin.user.index')->with(['error' => 'Data Gagal Disimpan!']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.user.index')->with(['error' => 'Data Gagal Disimpan ' . $e->getMessage()]);
        }
    }

    public function edit(User $user)
    {
        $roles = Role::latest()->get();

        return view('pages.admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,

        ]);

        $user = User::findOrFail($user->id);

        if ($request->input('password') == '') {
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);
        } else {
            // validasi password
            $this->validate($request, [
                'password' => 'required|confirmed',
            ]);
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
        }

        //assign role

        $user->syncRoles($request->input('role'));

        if ($user) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.user.index')->with(['error' => 'Data Gagal disimpan!']);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($user) {

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
