<?php

namespace App\Livewire\Pages\User\ProductCart;
use App\Models\ProductCart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductCartCount extends Component
{

    public $cartCount;

    // protected $listeners = ['CartAddedUpdated' => 'checkCartCount'];

    public function checkCartCount(){

        if(Auth::check()){
            return $this->cartCount = ProductCart::where('user_id', Auth::user()->id)->count();
        }
        else{
            return $this->cartCount =0;
        }

    }
    public function render()
    {
        $this->cartCount = $this->checkCartCount();
        return view('livewire.pages.user.productcart.product-cart-count',['cartCount'=>$this->cartCount]);
    }
}
