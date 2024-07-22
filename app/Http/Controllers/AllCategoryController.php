<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Accessory;
use App\Models\Laptop;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\models\ProductBrand;
use App\models\ProductCategory;
class AllCategoryController extends Controller
{


    // public function productshow($brandName){
    //     $brand = ProductBrand::where('brand',$brandName)->first();
    //     $brandname = ProductBrand::all();

    //     $products = Product::query()->where('brand_id',$brand->id)->get();
    //     return view('brand.show',['brand'=>$brand,'products'=>$products,'brandname'=>$brandname]);
    // }
    public function productshow($brandName) {
        // Get the brand details
        $brand = ProductBrand::where('brand', $brandName)->first();

        // Get all product brands
        $brandnames = ProductBrand::all();

        // Get all product categories
        $productCategories = ProductCategory::all();

        // Initialize an empty array to hold sorted products
        $sortedProducts = [];

        // Loop through each category
        foreach ($productCategories as $category) {
            // Get products for the current category and specified brand
            $products = Product::where('brand_id', $brand->id)
                               ->where('productcategory_id', $category->id)
                               ->get();

            // Add the category name and products to the sorted array
            $sortedProducts[$category->category_name] = $products;
        }

        // Pass the brand, products, product brands, and sorted products to the view
        return view('brand.show', [
            'brand' => $brand,
            'brandnames' => $brandnames,
            'sortedProducts' => $sortedProducts
        ]);
    }


    public function viewdetailproduct($model){
        $brandnames = ProductBrand::all();
        $product = Product::where('model',$model)->first();
        return view('pages.user.viewproduct',['product' => $product,'brandnames' => $brandnames]);
    }

    //Laptop and accessory














}
