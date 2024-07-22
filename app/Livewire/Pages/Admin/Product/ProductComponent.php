<?php

namespace App\Livewire\Pages\Admin\Product;

use Livewire\Component;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\RenewStockProduct;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class ProductComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $selectedCategory = null;
    public $selectedBrand = null;
    public $perPage = 5;
    #[Rule('required|integer')]
    public $productcategory_id;
    #[Rule('required|integer')]
    public $brand_id;
    #[Rule('required|string|max:50')]
    public $model;
    #[Rule('required|regex:/^\d+(\.\d{1,2})?$/')]
    public $price;
    #[Rule('required|integer|min:0')]
    public $quantity;
    #[Rule('nullable|string|max:100')]
    public $gpu;
    #[Rule('nullable|string|max:50')]
    public $cpu;
    #[Rule('nullable|string|max:50')]
    public $ram;
    #[Rule('required|string|max:50')]
    public $color;
    #[Rule('nullable|string|max:100')]
    public $display;
    #[Rule('nullable|string|max:50')]
    public $weight;
    #[Rule('nullable|string|max:50')]
    public $battery;


    public $image;
    #[Rule('nullable|string|max:100')]
    public $official_warranty;
    #[Rule('nullable|string|max:100')]

    public $description;

    public $product_id;

    // public $new_image;

    public $old_image;

    public $productId;

    public $product;

    public $start_date;

    public $end_date;
    public $sortBy = 'id';
    public $sortDirection = 'desc';
    public $renewproduct_id;
    // #[Rule('nullable|string|max:50')]
    public $renewmodel ;
    // #[Rule('required|integer')]
    public $renewquantity;
    // #[Rule('required|regex:/^\d+(\.\d{1,2})?$/')]
    public $renewprice;
    public $total_amount ;



    // Your other methods...

    public function resetfield(){
        $this->reset('productcategory_id', 'brand_id', 'model', 'price', 'quantity', 'gpu', 'cpu', 'color', 'display', 'weight', 'battery', 'official_warranty', 'image', 'description');

    }
    public $updateTrigger = false ;
    //FIXME:When the record is delete the image source should be delete too...
    public function storeProduct()
    {


        $validate = $this->validate();
        if ($this->image) {
            //Store the image and get the stored path
            $imagePath = $this->image->store('productuploads', 'public');
            $validate['image'] = $imagePath;

            //Get the full path of the temporary file
            $tempPath = $this->image->getRealPath();

            if (file_exists($tempPath)) {
                unlink($tempPath);
            }
        }

        //Create Produdct record with validate data
        Product::create($validate);

        $this->reset('productcategory_id', 'brand_id', 'model', 'ram', 'price', 'quantity', 'gpu', 'cpu', 'color', 'display', 'weight', 'battery', 'official_warranty', 'image', 'description');
        session()->flash('success', 'Product Created');
        $this->dispatch('close-modal');
    }

    public function editProduct(int $product_id)
    {
        $this->product = Product::find($product_id);
        $this->productcategory_id = $this->product->productcategory_id;
        $this->brand_id = $this->product->brand_id;
        $this->model = $this->product->model;
        $this->price = $this->product->price;
        $this->quantity = $this->product->quantity;
        $this->gpu = $this->product->gpu;
        $this->cpu = $this->product->cpu;
        $this->ram = $this->product->ram;
        $this->color = $this->product->color;
        $this->display = $this->product->display;
        $this->weight = $this->product->weight;
        $this->battery = $this->product->battery;
        $this->official_warranty = $this->product->official_warranty;
        $this->old_image = $this->product->image;
        $this->description = $this->product->description;

    }

    //update product

    public function updateProduct()
    {
        $validate = $this->validate();
        if ($this->image) {
            // If the product already has an image, delete the old one
            if ($this->product->image) {
                Storage::disk('public')->delete($this->product->image);
            }

            // Store the new image and get its stored path
            $imagePath = $this->image->store('productuploads', 'public');

            // Add the new image path to the validated data
            $validate['image'] = $imagePath;
        } else {
            // If no new image is provided, keep the old image
            $validate['image'] = $this->product->image;
        }
        //Update the product record with validate data
        $this->product->update($validate);

        $this->reset('productcategory_id', 'brand_id', 'model', 'price', 'quantity', 'gpu', 'cpu', 'color', 'display', 'weight', 'battery', 'official_warranty', 'image', 'description');
        session()->flash('message', 'Produt Update Successful');
        $this->dispatch('close-modal');
        $this->updateTrigger=true;

    }

    // public function deleteProducts()
    // {
    //     $start_date = Carbon::parse($this->start_date)->startOfDay();
    //     $end_date = Carbon::parse($this->end_date)->endOfDay();
    //     Product::whereBetween('created_at', [$start_date, $end_date])->delete();
    // }

    public function resetTable()
    {

        DB::statement('ALTER TABLE products AUTO_INCREMENT = 1;');
    }

    //Delete function

    public function deleteProduct($product_id)
    {
        $this->product_id = $product_id;
    }

    public function destroyProduct()
    {
        $product = Product::find($this->product_id);
        if (!$product) {
            session()->flash('error', 'Product not found');
            return;
        }

        //FIXME: THIS SHOULD BE WORK ON IT
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        session()->flash('delete', 'Product Delete Sucessfully');
        $this->dispatch('close-modal');
    }

    //edit product
    //TODO: Should clear the field if the edit is close without update

    public function toggleSort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }



    public function editStockProduct(int $renewproduct_id){
        $this->renewproduct_id = $renewproduct_id;
    }


//FIXME: RenewStock
    public function storeRenewStockProduct()
{
    $product = Product::find($this->renewproduct_id);

    // Validate only the specified fields
    $validatedData = $this->validate([
        'renewquantity' => 'required|integer',
        'renewprice' => 'required|regex:/^\d+(\.\d{1,2})?$/',
    ]);
    $validatedData['product_id'] = $this->renewproduct_id;
    $validatedData['renewmodel'] = $product->model;

    // Calculate total amount
    $validatedData['total_amount'] = $this->renewquantity * $this->renewprice;

    // Create a new RenewStockProduct record
    RenewStockProduct::create($validatedData);

    // Update product quantity
    $product->quantity += $this->renewquantity;
    $product->save();

    // Reset form fields and close the modal
    $this->reset(['product_id', 'renewmodel', 'renewquantity', 'renewprice']);
    $this->dispatch('close-modal');
}





    public function render()
    {
        $productcategories = ProductCategory::all();
        $productbrands = ProductBrand::all();

        $productsQuery = Product::orderBy($this->sortBy, $this->sortDirection)
        ->where('model', 'like', "%{$this->search}%");



    if ($this->selectedCategory) {
        $productsQuery->where('productcategory_id', $this->selectedCategory);
    }
    if ($this->selectedBrand){
        $productsQuery->where('brand_id',$this->selectedBrand);
    }
    $perPage = $this->perPage == 'all' ? $productsQuery->count():$this->perPage;
    $products = $productsQuery->paginate($perPage);

        return view('livewire.pages.admin.product.product-component', [
            'productcategories' => $productcategories,
            'products' => $products,
            'productbrands' => $productbrands,
        ]);
    }


}
