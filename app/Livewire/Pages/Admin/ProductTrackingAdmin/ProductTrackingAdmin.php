<?php

namespace App\Livewire\Pages\Admin\ProductTrackingAdmin;

use App\Models\OrderItemProduct;
use App\Models\OrderProduct;
use App\Models\Product;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;

class ProductTrackingAdmin extends Component
{   
    use WithPagination;

    public $startDate ;
    public $endDate ;
    public $perPage;
    public $product_id;
    public function markOrderReturned($orderId)
    {
        $orderItems = OrderItemProduct::where('order_id', $orderId)->get();

        foreach ($orderItems as $orderItem) {

            $product = $orderItem->product;
            if ($product->quantity >= $orderItem->quantity) {

                $product->quantity -= $orderItem->quantity;

                $order = OrderProduct::find($orderId);

                if ($order->status !== 'confirm') {
                    $order->status = 'confirm';
                    $order->save();
                }
            } else {
                session()->flash('delete', 'out of stock');
                break;
            }
            $product->save();
        }
    }

    public function cancelOrder($orderId)
    {
        $order = OrderProduct::find($orderId);

        if ($order->status !== 'confirm') {
            $order->status = 'cancel';
            $order->save();
        }
    }
    public function mount()
{
    $this->startDate = now()->subDays(7)->format('Y-m-d');
    $this->endDate = now()->format('Y-m-d');
}

    public function render()
    {

        $startDate = Carbon::parse($this->startDate)->startOfDay();
        $endDate = Carbon::parse($this->endDate)->endOfDay();
        if($this->perPage=='all'){
        $orders = OrderProduct::whereBetween('created_at', [$startDate , $endDate])->get();
        }
        else{
            $orders = OrderProduct::whereBetween('created_at', [$startDate , $endDate])->paginate($this->perPage);
        }
        return view('livewire.pages.admin.producttrackingadmin.product-tracking-admin',['orders'=>$orders]);
    }
}
