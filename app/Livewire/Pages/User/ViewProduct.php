<?php

namespace App\Livewire\Pages\User;

use Livewire\Component;
use App\Models\ProductCart;
use Illuminate\Support\Facades\Auth;
class ViewProduct extends Component
{
    public $product , $quantityCount = 1 ;

    public function incrementQuantity(){
        if($this->quantityCount<10){
            $this->quantityCount++;
        }
    }

    public function decrementQuantity(){
        if($this->quantityCount>1){
            $this->quantityCount--;
        }
    }

    public function props($product){
        $this->product = $product;
    }

    public function addToCard(int $productId){
        if (Auth::check()) {
            // dd($productId);
            if(Auth::user()->role == 0) {
                if ($this->product->where('id', $productId)) {
                    if (ProductCart::where('user_id', Auth::user()->id)->where('product_id', $productId)->exists()) {
                        session()->flash('error', 'Product Already Addes');
                    } else {
                        if ($this->product->quantity > 0) {
                            if ($this->product->quantity >= $this->quantityCount) {
                                ProductCart::create([
                                    'user_id' => Auth::user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount
                                ]);

                                session()->flash('message', 'Product Add to Cart Successfully');

                            } else {
                                session()->flash('error', 'Only ' . $this->product->quantity . 'Quantity Available');
                            }
                        } else {
                            session()->flash('error', 'out of stock');
                        }
                    }
                } else {
                    session()->flash('error', 'product Does not');
                }
            }else {
                session()->flash('error', 'You are admin.');
            }

        } else {
            session()->flash('error', 'login to add to card');
        }
    }


    public function render()
    {

        return view('livewire.pages.user.view-product',[
            'product' => $this->product
        ]);
    }
}
