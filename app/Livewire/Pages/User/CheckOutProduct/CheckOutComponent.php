<?php

namespace App\Livewire\Pages\User\CheckOutProduct;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use App\Models\OrderItemProduct;
use App\Models\OrderProduct;
use App\Models\ProductCart;
use App\Models\Qrcode;

class CheckOutComponent extends Component
{
    use WithFileUploads;
    public $carts, $totalProductAmount = 0;

    #[Rule('required|string|max:20')]
    public $fullname;

    #[Rule('required')]
    public $payment_qr;

    #[Rule('required|string|max:20')]
    public $phonenumber;

    #[Rule('required|string|max:100')]
    public $address;

    public $total_amount;


    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = ProductCart::where('user_id', auth()->user()->id)->get();
        foreach ($this->carts as $cartItem) {
            $this->totalProductAmount += $cartItem->product->price * $cartItem->quantity;
        }
        return $this->totalProductAmount;
    }

    public function placeOrder()
    {
        $validate = $this->validate();
        if ($this->payment_qr) {
            $imagePath = $this->payment_qr->store('paymentproduct', 'public');
            $validate['payment_qr'] = $imagePath;
            $tempPath = $this->payment_qr->getRealPath();
            if (file_exists($tempPath)) {
                unlink($tempPath);
            }
        }
        $validate['user_id'] = auth()->user()->id;
        $validate['full_name'] = auth()->user()->name;
        $validate['phone_number'] = $this->phonenumber;
        $validate['total_amount'] = $this->totalProductAmount();
        $order = OrderProduct::create($validate);

        foreach ($this->carts as $cartItem) {
            OrderItemProduct::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product->id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
        }
        return $order;
    }

    //after check out \

    public function codOrder()
    {
        $codOrder = $this->placeOrder();
        if ($codOrder) {
            if ($codOrder) {
                ProductCart::where('user_id', auth()->user()->id)->delete();
                // FIXME:"Fix Tracking Product Livewire"
                return redirect()->route('tracking_product');
                session()->flash('message', 'Order Item Successfully, Please wait for admin confirm ');
            } else {
                session()->flash('error', 'Something went wrong');
            }
        }
    }

    public function render()

    {
        $qr_code = Qrcode::all();
        $this->fullname = auth()->user()->name;
        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.pages.user.checkoutproduct.check-out-component', ['totalProductAmount' => $this->totalProductAmount,'qr_code'=>$qr_code]);
    }
}
