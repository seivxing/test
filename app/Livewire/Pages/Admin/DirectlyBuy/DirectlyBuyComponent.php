<?php

namespace App\Livewire\Pages\Admin\DirectlyBuy;

use Livewire\Component;
use App\Models\ProductCategory;
use App\Models\ProductBrand;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\DirectlyBuy;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;

class DirectlyBuyComponent extends Component
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
    #[Rule('nullable|string|max:50')]
    public $gpu;
    #[Rule('nullable|string|max:50')]
    public $cpu;
    #[Rule('nullable|string|max:50')]
    public $ram;
    #[Rule('required|string|max:50')]
    public $color;
    #[Rule('nullable|string|max:50')]
    public $display;
    #[Rule('nullable|string|max:50')]
    public $weight;
    #[Rule('nullable|string|max:50')]
    public $battery;

    public $image;
    #[Rule('required|string|max:50')]
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

    public $buy_id;

    public $buy;


    public function storeBuyProduct()
    {
        $validate = $this->validate();

        $validate['total_amount'] = $this->quantity * $this->price;
        if ($this->image) {
            $imagePath = $this->image->store('directlybuy', 'public');
            $validate['image'] = $imagePath;
            $tempPath = $this->image->getRealPath();
            if (file_exists($tempPath)) {
                unlink($tempPath);
            }
        }
        DirectlyBuy::create($validate);
        $this->reset('productcategory_id', 'brand_id', 'model', 'price', 'quantity', 'gpu', 'cpu', 'display', 'weight', 'battery', 'official_warranty', 'image', 'description');
        session()->flash('success', 'Directly_Buy record Created');
        $this->dispatch('close-modal');
    }

    //Delete
    public function deleteBuyProduct($buy_id)
    {
        $this->buy_id = $buy_id;
    }

    public function destroyBuyProduct()
    {
        $buyproduct = DirectlyBuy::find($this->buy_id);
        if (!$buyproduct) {
            session()->flash('error', 'Record not found');
            return;
        }

        // Delete image from storage
        if ($buyproduct->image) {
            Storage::disk('public')->delete($buyproduct->image);
        }

        $buyproduct->delete();
        session()->flash('message', 'Record deleted');
        $this->dispatch('close-modal');
    }

    public function editBuyProduct(int $buy_id)
    {
        $this->buy = DirectlyBuy::find($buy_id);
        $this->productcategory_id = $this->buy->productcategory_id;
        $this->brand_id = $this->buy->brand_id;
        $this->model = $this->buy->model;
        $this->price = $this->buy->price;
        $this->quantity = $this->buy->quantity;
        $this->gpu = $this->buy->gpu;
        $this->cpu = $this->buy->cpu;
        $this->ram = $this->buy->ram;
        $this->color = $this->buy->color;
        $this->display = $this->buy->display;
        $this->weight = $this->buy->weight;
        $this->battery = $this->buy->battery;
        $this->official_warranty = $this->buy->official_warranty;
        $this->old_image = $this->buy->image;
        $this->description = $this->buy->description;
    }

    //TODO:
    //Report [profits] =     (addstockproduct[total_amount] + renewstockproduct[total_amount])-(orderproduct[total_amount] + directlybuy[total_amount])
    //Report [expense] =     (addstockproduct[total_amount] + renewstockproduct[total_amount])
    //Report [revenue] =     (orderproduct[total_amount] + directlybuy[total_amount])

    //Most sale Product = ?
    //TODO:To find the most sold product, calculate the total quantity sold for each product within a given month
    //product_id & count(quantity)
    //TODO::Sum up the quantities from order items for each product
    //FIXME:  sum quantity in  orderitemproduct for specific time

    public function updateBuyProduct()
    {
        $validate = $this->validate();
        if ($this->image) {
            if ($this->buy->image) {
                Storage::disk('public')->delete($this->buy->image);
            }
            $imagePath = $this->image->store('directlybuy', 'public');
            $validate['image'] = $imagePath;
        }
        $validate['total_amount'] = $validate['quantity'] * $validate['price'];

        $this->buy->update($validate);
        $this->reset('productcategory_id', 'brand_id', 'model', 'price', 'quantity', 'gpu', 'cpu', 'color', 'display', 'weight', 'battery', 'official_warranty', 'image', 'description');
        session()->flash('message', 'Product Update Successfully');
        $this->dispatch('close-modal');
    }

    public function render()
    {
        $productcategories = ProductCategory::all();
        $productbrands = ProductBrand::all();
        $buyproducts = DirectlyBuy::orderBy('id', 'ASC')->where('model', 'like', "%{$this->search}%")->paginate($this->perPage);
        return view('livewire.pages.admin.directlybuy.directly-buy', ['productbrands' => $productbrands, 'productcategories' => $productcategories, 'buyproducts' => $buyproducts]);
    }
}
