<?php

namespace App\Http\Controllers;

use App\Http\Traits\ModelScopes;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ModelScopes;
    public function index()
    {
        $id = Auth()->user()->id;
        //   $categories = Category::where('user_id','=',$id)->with('products')->get();
        $categories = Category::self()->get();

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


    public function store(Request $request)
    {
      //  return   $request->user_id;
        $attributes = request()->validate([
            'category_name' => 'required|min:2',
            'user_id'=>'required'
        ]);
        $attributes['user_id'] = $request->user_id;
        $attributes = $request->all();
        Category::create($attributes);
        return redirect('/categories')->with('message', 'Category Addedd SuccessFully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.update', compact('category'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $category = Category::findOrFail($id);

        $request->validate([
            'category_name' => 'required|min:2',
        ]);

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
