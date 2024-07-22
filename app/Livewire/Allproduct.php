<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Redirect;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Slider;

class Allproduct extends Component
{


    public function redirectToproductbrand($brandId){
        $brandname = ProductBrand::find($brandId);
        return Redirect::route('brand.show', ['brand' => $brandname->brand]);

    }


    public function render()
{
    // Get all product categories
    $productCategories = ProductCategory::all();

    // Initialize an empty array to hold sorted products
    $sortedProducts = [];
    $productbrands = ProductBrand::all();
    // Loop through each category
    foreach ($productCategories as $category) {
        // Get products for the current category
        $products = Product::where('productcategory_id', $category->id)->get();

        // Add the category name and products to the sorted array
        $sortedProducts[$category->category_name] = $products;
    }

    $sliders = Slider::where('status', '0')->get();

    // Pass the sorted products to the view
    return view('livewire.pages.user.allproduct', ['sortedProducts' => $sortedProducts,'productbrands'=>$productbrands],compact('sliders'));
}
}
