<?php

namespace App\Livewire\Pages\Admin\RenewStockProduct;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\RenewStockProduct;
use Livewire\WithPagination;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use App\Models\Product;
class RenewStockProductComponent extends Component
{
    use WithPagination;
    public $exchangeRate;
    protected $pagniationTheme = 'bootstrap';
    public $perPage = 5 ;
    public $search;
    public  $startDate ;
    public $endDate ;
    public $model;

    public $renew_id;
    #[Rule('nullable|integer')]
    public $product_id;

    #[Rule('nullable|string|max:50')]
    public $renewmodel ;
    #[Rule('required|integer')]
    public $renewquantity;
    #[Rule('required|regex:/^\d+(\.\d{1,2})?$/')]
    public $renewprice;
    public $total_amount ;
    public $stock;
    public $stock_id;

    public $sortBy = 'id';
    public $sortDirection = 'desc';

    public $productid;
    public $oldrenewquantity;




// TODO: Edit
public function editStockProductrenew(int $stock_id){
    $this->stock = RenewStockProduct::find($stock_id);
    $this->renewquantity = $this->stock->renewquantity;
    $this->renewprice = $this->stock->renewprice;
    $this->product_id = $this->stock->product_id;
    $this->oldrenewquantity = $this->stock->renewquantity;

}

// TODO:Update
public function updateStockProduct(){

    $validate = $this->validate();

    $oldrenewquantity=$this->oldrenewquantity;


    $validate['total_amount'] = $validate['renewquantity'] * $validate['renewprice'];
    unset($validate['product_id']);
    unset($validate['renewmodel']);
    $this->stock->update($validate);
    $product = Product::find($this->product_id);
    $product->quantity += $this->renewquantity - $oldrenewquantity ;

    // dd($product->quantity);
    // dd($this->renewquantity);
    // dd($this->oldrenewquantity);
    $product->save();
    session()->flash('message','RenwewStock Update Successfully');
    $this->reset('renewquantity','renewprice','oldrenewquantity');
    $this->dispatch('close-modal');
}


public function storeRenewStockProduct(){
    $validate = $this->validate();
    $validate['total_amount'] = $this->quantity * $this->price;

    RenewStockProduct::create($validate);

    //product
    $product = Product::find($this->product_id);
    $product->quantity += $this->quantity;
    $product->save();

    $this->reset('product_id','model','quantity','price');
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

//delete
public function deleteStockProduct($renew_id){
    $this->renew_id = $renew_id;
}
public function destroyStockProduct(){
    $renew_stock_product = RenewStockProduct::find($this->renew_id);
    if(!$renew_stock_product){
        session()->flash('error','Product not found');
        return ;
    }
    $renew_stock_product->delete();
    session()->flash('message','StockProduct Delete Successfully');
    $this->dispatch('close-modal');
}

//Mount Date from now and previous 7 day
public function mount()
    {
        $this->startDate = now()->subDays(7)->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }

public function render()
{
    $products = Product::all();
    $startDate = Carbon::parse($this->startDate)->startOfDay();
    $endDate = Carbon::parse($this->endDate)->endOfDay();
    $totalAmount = RenewStockProduct::whereBetween('created_at', [$startDate, $endDate])->sum('total_amount');

    if($this->perPage == 'all'){
        $renewstocks = RenewStockProduct::orderBy($this->sortBy, $this->sortDirection)
        ->where('renewmodel', 'like', "%{$this->search}%")->whereBetween('created_at',[$startDate,$endDate])
        ->get();
    }
    else{
        $renewstocks = RenewStockProduct::orderBy($this->sortBy, $this->sortDirection)
        ->where('renewmodel', 'like', "%{$this->search}%")->whereBetween('created_at',[$startDate,$endDate])
        ->paginate($this->perPage);
    }

    return view('livewire.pages.admin.renewstockproduct.renew-stock-product-component', [
        'renewstocks' => $renewstocks,
        'products' => $products,
        'totalAmount' => $totalAmount,
    ]);
}


}

