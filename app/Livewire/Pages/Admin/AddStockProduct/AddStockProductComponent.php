<?php

namespace App\Livewire\Pages\Admin\AddStockProduct;

use Livewire\Component;
use App\Models\AddStockProduct;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\ProductCategory;
use App\Models\ProductBrand;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class AddStockProductComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $search;
    protected $paginationTheme = 'bootstrap';
    public $total_amount;
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
    public $cpu ;
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

    public $startDate;
    public $endDate;

    public $image;
    #[Rule('nullable|string|max:50')]
    public $official_warranty;
    #[Rule('nullable|string|max:50')]
    public $description;

    public $product_id;

    public $new_image;

    public $old_image;

    public $productId;

    public $product;

    public $start_date;

    public $end_date;

    public $stock_id;

    public $stock;
    public $selectedCategory=null;
    public $selectedBrand = null;
    public $sortBy = 'id';
    public $sortDirection = 'desc';

    public function storeStockProduct(){
        $validate = $this->validate();
        $validate['total_amount'] = $this->quantity * $this->price;
        if($this->image){
            $imagePath = $this->image->store('stockproduct','public');
            $validate['image'] = $imagePath;
            $tempPath = $this->image->getRealPath();
            if(file_exists($tempPath)){
                unlink($tempPath);
            }
        }

    AddStockProduct::create($validate);

    unset($validate['total_amount']);


    Product::create($validate);

    $this->reset('productcategory_id','brand_id','model','price','quantity','gpu','cpu','display','weight','battery','official_warranty','image','description');
    session()->flash('success','Stockproduct Created');
    $this->dispatch('close-modal');
}
    public function deleteProductstock($product_id){
        $this->product_id = $product_id;
    }

    // TODO: Edit
    public function editStockProduct(int $stock_id){
     $this->stock =  AddStockProduct::find($stock_id);
     $this->productcategory_id = $this->stock->productcategory_id;
     $this->brand_id = $this->stock->brand_id;
     $this->model = $this->stock->model;
     $this->price = $this->stock->price;
     $this->quantity = $this->stock->quantity;
     $this->gpu = $this->stock->gpu;
     $this->cpu = $this->stock->cpu;
     $this->ram = $this->stock->ram;
     $this->color = $this->stock->color;
     $this->display = $this->stock->display;
     $this->weight = $this->stock->weight;
     $this->battery = $this->stock->battery;
     $this->official_warranty = $this->stock->official_warranty;
     $this->old_image = $this->stock->image;
     $this->description = $this->stock->description;

    }


    // TODO:Update
    public function updateStockProduct(){
        $validate = $this->validate();
        if($this->image){
            if($this->stock->image){
                Storage::disk('public')->delete($this->stock->image);
            }
            $imagePath = $this->image->store('stockproduct','public');
            $validate['image'] = $imagePath;
        }
        $validate['total_amount'] = $validate['quantity'] * $validate['price'];
        $this->stock->update($validate);
        $this->reset('productcategory_id','brand_id','model','price','quantity','gpu','cpu','color','display','weight','battery','official_warranty','image','description');
        session()->flash('message','Product Update Successfully');
        $this->dispatch('close-modal');

    }
    // FIXME: update delete source image
    public function destroyProductstock(){
        $stockproduct = AddStockProduct::find($this->product_id);
        if(!$stockproduct){
            session()->flash('error','Product not found');
            return ;
        }
        if($stockproduct ->image){
            Storage::disk('public')->delete($stockproduct->image);
        }
        $stockproduct->delete();
        session()->flash('message','StockProduct Deleted Successfully');
        $this->dispatch('close-modal');
    }
    public function toggleSort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function mount()
    {
        $this->startDate = now()->subDays(7)->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }


    public function render()
    {
        $productcategories = ProductCategory::all();
        $startDate = Carbon::parse($this->startDate)->startOfDay();
        $endDate = Carbon::parse($this->endDate)->endOfDay();
        $totalAmount = AddStockProduct::whereBetween('created_at',[$startDate,$endDate])->sum('total_amount');
        $productbrands = ProductBrand::all();

        $stockproductsQuery = AddStockProduct::orderBy($this->sortBy, $this->sortDirection)->where('model','like',"%{$this->search}%");

        if($this->selectedBrand){
            $stockproductsQuery->where('brand_id',$this->selectedBrand);
        }

        if($this->selectedCategory){
            $stockproductsQuery->where('productcategory_id',$this->selectedCategory);
        }
        $perPage = $this->perPage == 'all' ? $stockproductsQuery->count() : $this->perPage;
        $stockproducts = $stockproductsQuery->paginate($perPage);


        return view('livewire.pages.admin.addstockproduct.add-stock-product-component',['productcategories'=>$productcategories,'productbrands'=>$productbrands,'stockproducts'=>$stockproducts,'totalAmount'=>$totalAmount]);
    }
}
