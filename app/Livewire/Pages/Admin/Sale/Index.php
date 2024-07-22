<?php

namespace App\Livewire\Pages\Admin\Sale;

use App\Models\OrderItemProduct;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCart;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $cart, $totalPrice  = 0, $id, $address, $status, $payment_qr,$name, $phone;
    
    
    protected $rules = [
        'name' => 'required|string|max:50',
        'phone' => 'required|string|max:50',
    ];

    public function render()
    {
        $this->cart = ProductCart::where('user_id', auth()->user()->id)->get();
        $products = Product::orderBy('id', 'ASC')->paginate(10);
        $productbrands = ProductBrand::all();
        return view('livewire.pages.admin.sale.index', ['products' => $products, 'productbrands' => $productbrands, 'cart' => $this->cart]);
    }

    public function addToCard(int $productId)
    {

        if (ProductCart::where('user_id', Auth::user()->id)->where('product_id', $productId)->exists()) {
            session()->flash('error', 'Product Already Addes');
        } else {
            ProductCart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }
    }

    public function removeCartItem(int $cartId)
    {
        $cartRemoveDate = ProductCart::where('user_id', auth()->user()->id)->where('id', $cartId)->first();
        if ($cartRemoveDate) {
            $cartRemoveDate->delete();
            session()->flash('message', 'Cart Item Remove Successfully');
        }
    }

    public function decrementQuantity(int $cardId)
    {
        $cartData = ProductCart::where('id', $cardId)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {
            $cartData->decrement('quantity');
        };
    }
    public function incrementQuantity(int $cardId)
    {
        $cartData = ProductCart::where('id', $cardId)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {
            if ($cartData->product->quantity > $cartData->quantity) {
                $cartData->increment('quantity');
            } else {
                session()->flash('error', 'Only' . $cartData->product->quantity . 'Quantity Available');
            }
        }
    }

    public function totalPrice()
    {
        $this->totalPrice = 0;
        $this->cart = ProductCart::where('user_id', auth()->user()->id)->get();
        foreach ($this->cart as $cartitem) {
            $this->totalPrice += $cartitem->product->price * $cartitem->quantity;
        }
        return $this->totalPrice;
    }


    public function placeOrder()
    {   

        $this->validate();

        $order = OrderProduct::create([
            'user_id' => $this->id=1,
            'full_name' => $this->name,
            'phone_number' => $this->phone,
            'address' => $this->address = "####",
            'status' => $this->status = "confirm",
            'payment_qr' => $this->payment_qr = "###",
            'total_amount' => $this->totalPrice(),
        ]);


        foreach ($this->cart as $cartitem) {
            OrderItemProduct::create([
                'order_id' => $order->id,
                'product_id' => $cartitem->product->id,
                'quantity' => $cartitem->quantity,
                'price' => $cartitem->product->price,
            ]);

            $cartitem->product()->where('id', $cartitem->product_id)->decrement('quantity', $cartitem->quantity);
        }
        return $order;
    }

    public function codOrder()
    {
        $codOrder = $this->placeOrder();
        if ($codOrder) {
            if ($codOrder) {
                ProductCart::where('user_id', auth()->user()->id)->delete();
                // FIXME:"Fix Tracking Product Livewire"
                session()->flash('message', 'Order Item Successfully.');
                if(Auth::user()->role ==1){
                    return redirect()->route('sale');
                }else{
                    return redirect()->route('sale_sale');
                }
            } else {
                session()->flash('error', 'Something went wrong');
            }
        }
    }
}
