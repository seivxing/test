<?php

namespace App\Livewire\Pages\User\ProductCart;

use Livewire\Component;
use App\Models\ProductCart;
class ProductCartShow extends Component
{
    public $cart , $totalPrice  = 0;

    public function decrementQuantity(int $cardId){
        $cartData = ProductCart::where('id',$cardId)->where('user_id', auth()->user()->id)->first();
        if($cartData){
            $cartData->decrement('quantity');

        };
    }
        public function incrementQuantity(int $cardId){
            $cartData = ProductCart::where('id',$cardId)->where('user_id', auth()->user()->id)->first();
            if($cartData){
                if($cartData->product->quantity > $cartData->quantity){
                    $cartData->increment('quantity');
                }
                else{
                    session()->flash('error','Only'.$cartData->product->quantity .'Quantity Available');
                }
            }


        }
        public function removeCartItem(int $cartId){
            $cartRemoveDate = ProductCart::where('user_id',auth()->user()->id)->where('id',$cartId)->first();
            if($cartRemoveDate){
                $cartRemoveDate->delete();
                session()->flash('message','Cart Item Remove Successfully');
            }
        }






    public function render()
    {
        $this->cart = ProductCart::where('user_id',auth()->user()->id)->get();
        return view('livewire.pages.user.productcart.product-cart-show',['cart'=>$this->cart]);
    }
}
