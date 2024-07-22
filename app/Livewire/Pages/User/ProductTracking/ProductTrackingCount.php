<?php

namespace App\Livewire\Pages\User\ProductTracking;

use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductTrackingCount extends Component
{
    public $orderCount;
    public function checkTrackCount(){
        if(Auth::check()){
            return $this->orderCount = OrderProduct::where('user_id',Auth::user()->id)->where('status', 'in progress')->count();
        }
        else{
            return $this->orderCount = 0;
        }
    }
    public function render()
    {
        $this->orderCount = $this->checkTrackCount();
        return view('livewire.pages.user.producttracking.product-tracking-count',['orderCount' => $this->orderCount]);
    }
}
