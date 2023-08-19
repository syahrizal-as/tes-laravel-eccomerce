<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            $data = Permission::query()->orderBy('name', 'asc');

            return Datatables::of($data)
                ->addIndexColumn()

                ->make(true);
        }

        return view('pages.admin.permission.index');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $permission = Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'data berhasil disimpan',
        ]);
    }
}
