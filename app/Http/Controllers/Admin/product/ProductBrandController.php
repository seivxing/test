<?php

namespace App\Http\Controllers\Admin\product;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ProductBrand;
class ProductBrandController extends Controller
{
    public function  index(){
        return view('pages.admin.product.productbrand.productbrand');
    }
    public function create(){
        return view('pages.admin.product.productbrand.create');
    }
    public function store(Request $request){
        $request->validate([
            'brand'=>'required|max:15',
        ]);
        $productbrand = new ProductBrand();
        $productbrand->brand = strtoupper($request->brand);
        $productbrand->save();
        return redirect()->route('productbrand_index')->with('message','Productbrand created successfully');

    }

    // public function edit(ProductBrand $productbrand){
    //     return view('pages.admin.product.productbrand.edit',compact('productbrand'));
    // }
    public function edit(ProductBrand $brands){
        return view('pages.admin.product.productbrand.edit',compact('brands'));
    }
    public function update(Request $request, $brands){
        // $request->validate([
        //     'brand'=>'required|max:15',
        // ]);
        $brands = ProductBrand::findorFail($brands);
        $brands->brand = $request->brand;
        $brands->update();
        return redirect()->route('productbrand_index')->with('message','Productbrand updated successfully');
    }
}
