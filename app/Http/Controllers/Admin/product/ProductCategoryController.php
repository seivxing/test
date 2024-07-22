<?php

namespace App\Http\Controllers\Admin\product;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index(){
        return view('pages.admin.product.productcategory.productcategory');
    }
    public function create(){
        return view('pages.admin.product.productcategory.create');
    }

    public function store(Request $request){
        $request->validate([
            'category_name' => 'required|max:50',
        ]);

        $productcategory = new ProductCategory();
        $productcategory->category_name = strtoupper($request->category_name);
        $productcategory->save();
        return redirect()->route('productcategory_index')->with('message','productcategory created successfully');
    }

    public function edit(ProductCategory $productcategory){
        return view('pages.admin.product.productcategory.edit',compact('productcategory'));
    }
    public function update(Request $request , $productcategory){
        $request->validate([
            'category_name' =>'required|max:50',
        ]);
        $productcategory = ProductCategory::find($productcategory);
        $productcategory->category_name = strtoupper($request->category_name);
        $productcategory->update();

        return redirect()->route('productcategory_index')->with('message','Productcategory updated successfully');
    }
}
