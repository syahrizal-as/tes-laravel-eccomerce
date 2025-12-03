<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
     public function index()
    {

        if (request()->ajax()) {
            $data = Image::query();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if (auth()->user()->can('image.edit')) {
                        $btn = '<a href="javascript:void(0)" onClick="Edit('.$row->id.')"
                         data-toggle="tooltip"  data-original-title="Edit" class="edit btn btn-primary btn-sm editRole">Edit</a>';
                    } else {
                        $btn = '';
                    }

                    if (auth()->user()->can('image.delete')) {
                        $btn = $btn.' <a href="javascript:void(0)"  onClick="Delete(this.id)" data-toggle="tooltip"  id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteRole">Delete</a>';
                    } else {
                        $btn = $btn.'';
                    }
                    //

                    return '<div class="d-inline-block text-nowrap">'.$btn.'</div>';

                })
                ->editColumn('product_id', function ($row) {
                    return $row->product?->name;
                })
                ->editColumn('file', function ($row) {
                    return '<img src="'.$row->file.'" width="100" height="100">';
                })
                ->rawColumns(['action','file'])
                ->make(true);
        }

        $products   = Product::all();

        return view('pages.master-data.image.index', compact('products'));
    }

    public function create()
    {
        return view('pages.master-data.image.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'product_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $this->validate($request, $rules);

        $image = $request->file('image')->store('product_image', 'public');
        if($request->input('image_id')){
            // delete file
            $image_old = Image::findOrFail($request->input('image_id'));
            $oldPath = $image_old->getRawOriginal('file');
               if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
        }

        Image::updateOrCreate([
            'id' => $request->input('image_id'),
        ], [
            'product_id' => $request->input('product_id'),
            'file' => $image,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Image created successfully',
        ]);
    }

    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return response()->json([
            'image' => $image,
        ]);
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $oldPath = $image->getRawOriginal('file');
        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }
        $image->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Image deleted successfully',
        ]);
    }
}
