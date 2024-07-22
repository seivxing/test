<?php

namespace App\Livewire\Pages\Admin\OrderRecord;

use Livewire\Component;
use App\Models\OrderItemProduct;
use Carbon\Carbon;
class OrderRecordComponent extends Component
{
    public $startDate;
    public $endDate;
    public function render()
    {
        $startDate = Carbon::parse($this->startDate)->startOfDay();
        $endDate = Carbon::parse($this->endDate)->endOfDay();
        $productQuantities = OrderItemProduct::with('product') // Eager load the Product model
                            ->whereBetween('created_at', [$startDate, $endDate])
                            ->groupBy('product_id')
                            ->selectRaw('product_id, sum(quantity) as total_quantity')
                            ->get();

        return view('livewire.pages.admin.orderrecord.order-record-component',['productQuantities'=>$productQuantities]);
    }
}
