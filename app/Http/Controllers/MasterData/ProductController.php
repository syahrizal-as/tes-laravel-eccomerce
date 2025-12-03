<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            $data = Product::query();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if (auth()->user()->can('product.edit')) {
                        $btn = '<a href="javascript:void(0)" onClick="Edit('.$row->id.')"
                         data-toggle="tooltip"  data-original-title="Edit" class="edit btn btn-primary btn-sm editRole">Edit</a>';
                    } else {
                        $btn = '';
                    }

                    if (auth()->user()->can('product.delete')) {
                        $btn = $btn.' <a href="javascript:void(0)"  onClick="Delete(this.id)" data-toggle="tooltip"  id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteRole">Delete</a>';
                    } else {
                        $btn = $btn.'';
                    }
                    //

                    return '<div class="d-inline-block text-nowrap">'.$btn.'</div>';

                })
                ->editColumn('price', function ($row) {
                    return moneyFormat($row->price);
                })
                ->editColumn('stock', function ($row) {
                    return moneyFormat($row->stock);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.master-data.product.index');
    }

    public function create()
    {
        return view('pages.master-data.product.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:products,name',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
        ];

        if ($request->input('id')) {
            // UPDATE, pengecualian pada product id saat unique
            $rules['name'] = 'required|unique:products,name,' . $request->input('id');
        }
        $this->validate($request, $rules);

        $product = Product::updateOrCreate([
            'id' => $request->input('id'),
        ], [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
        ]);

       return response()->json([
           'status' => 'success',
           'message' => $request->input('id') ? 'Product updated successfully' : 'Product created successfully',
       ]);
    }

    public function edit(Product $product)
    {
        return response()->json([
            'product' => $product,
        ]);
    }

    

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        if ($product) {

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
