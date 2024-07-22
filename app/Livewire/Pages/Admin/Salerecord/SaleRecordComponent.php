<?php

namespace App\Livewire\Pages\Admin\Salerecord;
use App\Models\OrderItemProduct;
use Carbon\Carbon;
use Livewire\Component;

class SaleRecordComponent extends Component
{
    public $startDate;
    public $endDate;
    public function render()
    {
        $startDate = Carbon::parse($this->startDate)->startOfDay();
        $endDate = Carbon::parse($this->endDate)->endOfDay();
        $productQuantities = OrderItemProduct::with('product')
        ->join('order_product', 'order_item_product.order_id', '=', 'order_product.id')
        ->where('order_product.status', 'confirm')
        ->whereBetween('order_product.created_at', [$startDate, $endDate])
        ->groupBy('order_item_product.product_id')
        ->selectRaw('order_item_product.product_id, sum(order_item_product.quantity) as total_quantity')
        ->get();
        return view('livewire.pages.admin.salerecord.sale-record-component',['productQuantities'=>$productQuantities]);
    }
}
