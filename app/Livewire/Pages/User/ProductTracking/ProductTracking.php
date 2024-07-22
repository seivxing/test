<?php

namespace App\Livewire\Pages\User\ProductTracking;

use App\Models\OrderProduct;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\ProductBrand;
class ProductTracking extends Component
{
    public function redirecToproductbrand($brandId){
        $brandname = ProductBrand::find($brandId);
        return Redirect::route('brand.show', ['brand' => $brandname->brand]);
    }
    public function render()
    {
        $orders = OrderProduct::where('user_id',Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        $productbrands = ProductBrand::all();
        return view('livewire.pages.user.producttracking.product-tracking',['productbrands'=>$productbrands,'orders'=>$orders]);
    }
}
