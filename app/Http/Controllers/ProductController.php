<?php

namespace App\Http\Controllers;

use App\Http\Traits\ModelScopes;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use ModelScopes;
    public function indexVariant(Request $request)
    {
        $product_id = request()->id;
        return view('variant.add-remove-variant', compact('product_id'));
    }

    public function storeVariant(Request $request)
    {


        foreach ($request->moreFields as $key => $value) {
            Variant::create($value);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Product Variant Added Successfully',
        ]);
    }



    public function index(Request $request)
    {

        if (request()->ajax()) {
     
            $product = Product::self()->get();
            // return $product;
            return Datatables::of($product)
                ->setRowClass('{{ $id %2==0 ? "alert-success" : "alert-warning"}}')
                ->setRowId(function ($product) {
                    return $product->id;
                })
                ->addColumn('category', function ($product) {
                    return $product->category->category_name;
                })
                ->editColumn('created_at', function ($product) {
                    return $product->created_at;
                })
                ->editColumn('updated_at', function ($product) {
                    return $product->updated_at;
                })
                ->addColumn('action', function ($data) {
                    return '<button type="button" class=" btn btn-success btn-sm" id="getEditProductData" data-id="' . $data->id . '">Edit</button>
                    <button type="button" data-id="' . $data->id . '" data-toggle="modal" data-target="#DeleteArticleModal" class=" btn btn-danger btn-sm" id="getDeleteProduct">Delete</button>
                     <button type="button" class=" btn btn-info btn-sm" id="btnAddVariant" data-id="' . $data->id . '">Add Variant</button>
                       <button type="button" class=" btn btn-primary btn-sm" id="getShowVariants" data-id="' . $data->id . '">Show Variants</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $categories = Category::self()->get();
        return view('product.index', compact('categories'));
    }


    public function getVariants(Request $request, $id)
    {
        $product_id = $id;
        // dd($product_id);

        $variants = DB::table('variants')->select('name', 'id', 'price')->where('product_id', $product_id)->get();
        if (count($variants) > 0) {
            return response([
                'status' => 1,
                'message' => 'variants found',
                'variants' => $variants
            ]);
        } else {
            return response([
                'status' => 0,
                'message' => ' NO variants found for this product',
                //  'variants' => $variants
            ]);
        }
        //return Variant::with('product')->get()->groupBy('product_id');

    }


    public function create()
    {
        $categories = Category::self()->get();

        return view('product.create', compact('categories'));
    }


    public function store(Request $request)
    {
        // return 3434;
        // return $request->image;
        $attributes = request()->validate([
            'name' => 'required|min:2',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);

        $attributes['category_id'] = $request->category_id;
        $request->merge(['is_active' => $request->is_active ?? '0']);

        $attributes = $request->all();
        if ($request->hasFile('image')) {
            $attributes['image'] =  upload($request->image, 'products'); // products/asdfajerkuaher.jpg
        }


        //  return $request->subcategory;

        $product = Product::Create($attributes);

        $product->subcategories()->sync($request->subcategory);
        // return $product;
        //   return redirect('/products');
        return response()->json([
            'status' => 200,
            'message' => 'Product Added Successfully',
        ]);
    }


    public function subCat(Request $request)
    {


        $category_id = $request->cat_id;

        $subcategories = Category::where('id', $category_id)
            ->with('subcategories')
            ->get();
        return response()->json([
            'subcategories' => $subcategories
        ]);
    }

    public function edit($id)
    {

        $product = Product::with('subcategories')->findOrFail($id);
        $productSubcategories =  $product->subcategories->pluck('id');
        $categories = Category::self()->get();
        $subs = Subcategory::where('category_id', $product->category_id)->get();
        //     return view('product.index', compact('product', 'categories', 'subs', 'productSubcategories'));
        if ($product) {
            return response([
                'status' => 200,
                'product' => $product,
                'productSubcategories' => $productSubcategories,
                'categories' => $categories,
                'subs' => $subs

            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Product Not found',
            ]);
        }
    }


    public function update(Request $request)
    {

        $id = $request->id;
        $product = Product::findOrFail($id);
        $attributes = request()->validate([
            'name' => 'required|min:2',
            'category_id' => 'required',
            'subcategory' => 'required'
        ]);
        $request->merge(['is_active' => $request->is_active ?? '0']);
        $attributes = $request->all();
        $subcats = $request->subcategory;
        // return $attributes;
        $product->update($attributes);
        $product->subcategories()->sync($subcats);
        return response()->json([
            'status' => 200,
            'message' => 'Product Updated Successfully',
        ]);
        //$attributes = $request->all();
    }

    public function delete($id)
    {

        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Product Deleted  Successfully',
        ]);
    }
}
