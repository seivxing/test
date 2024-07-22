<?php

namespace App\Livewire\Pages\User\ProductTracking;

use App\Models\OrderProduct;
use App\Models\User; // Don't forget to import the User model
use Livewire\Component;

class ProductTrackingDetail extends Component
{
    public $orderId;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
    }

    public function render()
    {
        // Retrieve the order based on the provided order ID
        $order = OrderProduct::where('id', $this->orderId)->first();

        // Check if the order exists
        if (!$order) {
            return redirect()->back()->with('message', 'No Order Found');
        }

        // Access the user associated with the order
        $user = User::find($order->user_id);

        return view('livewire.pages.user.producttracking.product-tracking-detail', ['order' => $order, 'user' => $user]);
    }
}

