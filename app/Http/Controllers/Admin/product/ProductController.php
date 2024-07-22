<?php


namespace App\Http\Controllers\Admin\product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('pages.admin.product.product');
    }

    public function create(){
        $productbrands = ProductBrand::all();
        $productcategories = ProductCategory::all();
        return view('pages.admin.product.create-product',['productbrands' => $productbrands, 'productcategories' => $productcategories]);
    }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'productcategory_id' => 'required',
        'brand_id' => 'required',
        'model' => 'required',
        'ram' => 'nullable',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'gpu' => 'nullable',
        'cpu' => 'nullable',
        'color' => 'nullable',
        'display' => 'nullable',
        'weight' => 'nullable',
        'battery' => 'nullable',
        'official_warranty' => 'nullable|integer',
        'image' => 'required|image', // Validate image
        'description' => 'nullable',
    ]);

    // Handle image upload separately
    if ($request->hasFile('image')) {
        // Get the file from the request
        $file = $request->file('image');

        // Define the folder path
        $folder = 'productuploads';

        // Generate a unique file name
        $filename = time() . '_' . $file->getClientOriginalName();

        // Store the file in the specified folder within the storage directory
        $path = $file->storeAs($folder, $filename, 'public');

        // Return the path where the image was stored
        $validatedData['image'] = $path;

    }

    Product::create($validatedData);

    session()->flash('success', 'Product Created');

    return redirect()->route('product_index');
}
}
