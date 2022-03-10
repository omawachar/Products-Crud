<?php

namespace App\Http\Controllers;

use App\Http\Traits\ModelScopes;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    use ModelScopes;
    public function index()
    {

        $subcategories = $this->scopeSubcat(new Subcategory());

        return view('subcategory.index', compact('subcategories'));
    }
    public function create()
    {
        $categories = $this->scopeCategory(new Category());
        return view('subcategory.createSubcategory', compact('categories'));
    }
    public function store(Request $request)
    {
        $attributes = request()->validate([

            'category_id' => 'required',
            'name' => 'required|min:2',
            'user_id'=>'required'
        ]);
        $attributes['user_id'] = $request->user_id;
        $attributes = $request->all();
        Subcategory::create($attributes);
        return redirect('subcategories')->with('message', 'SubCategory Addedd SuccessFully');
    }
    public function edit($id)
    {
        $categories =Category::all();
        $subCategory = Subcategory::findOrFail($id);
        return view('subcategory.updateSubcategory', compact('subCategory', 'categories'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $subCategory = Subcategory::findOrFail($id);

        $request->validate([
            'category_id' => 'required',
            'name' => 'required|min:2',
            

        ]);

        $attributes = $request->all();

        $subCategory->update($attributes);
        return redirect('subcategories')->with('message', 'Subcategory Updated Successfully');
    }



    public function delete($id)
    {
        $subCategory = Subcategory::findOrFail($id);
        $subCategory->delete();
        return redirect('subcategories')->with('message', 'Subcategory deleted Successfully');
    }
}
