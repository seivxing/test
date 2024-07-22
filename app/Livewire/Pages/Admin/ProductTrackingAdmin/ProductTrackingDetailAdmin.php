<?php

namespace App\Livewire\Pages\Admin\ProductTrackingAdmin;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductTrackingDetailAdmin extends Component
{
    public $orderId;

    public function mount($orderId){
        $this->orderId = $orderId;
    }
    public function render()
    {
        $order = OrderProduct::where('user_id',Auth::user()->id)->where('id',$this->orderId)->first();
        if(!$order){
            return redirect()->back()->with('message', 'No Order Found');
        }
        return view('livewire.pages.admin.producttrackingadmin.product-tracking-detail-admin',['order'=>$order]);
    }
}
