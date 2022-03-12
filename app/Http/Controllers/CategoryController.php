<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\ModelScopes;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCatFormValidation;
use App\Http\Requests\updateCatFormValidation;

class CategoryController extends Controller
{
    use ModelScopes;
    public function index()
    {
        $id = Auth()->user()->id;
        //   $categories = Category::where('user_id','=',$id)->with('products')->get();
        $categories = Category::self()->withCount('products')->get();
//return $categories;
        // return $categories;
        // $categories = Category::whereHas('products', function($query) use($id){
        //     return $query->where('user_id','=',$id);
        // })->get();
        //all the products with category
        // $products = Product::where('user_id','=',$id)->get();
        $products = Product::self()->get();
      //  return  $products;

        return view('category.index', [
            'categories' => $categories,
            'products'  => $products
        ]);
    }

    public function create()
    {
        return view('category.createCategory');
    }


    public function store(StoreCatFormValidation $request)
    {
        //  return   $request->user_id; 
        $attributes = $request->validated();
        $attributes['user_id'] = $request->user_id;
        $attributes = $request->all();


        DB::beginTransaction();
        try {
            Category::create($attributes);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

       
        return redirect('/categories')->with('message', 'Category Addedd SuccessFully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.update', compact('category'));
    }

    public function update(updateCatFormValidation $request)
    {
        $id = $request->id;
        $category = Category::findOrFail($id);

        

        $attributes = $request->all();

        $category->update($attributes);
        return redirect('/')->with('message', 'Category Updated Successfully');
    }


    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('/')->with('message', 'Category deleted Successfully');
    }
}
