<?php

namespace App\Livewire\Pages\Admin\Report;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\DirectlyBuy;
use App\Models\AddStockProduct;
use App\Models\RenewStockProduct;
use App\Models\OrderProduct;
use App\Models\Report;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class ReportComponent extends Component
{


public $startDate;
public $endDate;
public $revenue ;
public $expense ;
public $profit ;




public $productCount;

    public function mount()
    {
        $this->productCount = $this->getProductCount();
    }

    public function getProductCount()
    {
        return Product::where('quantity', '>', 0)->count();
    }




    public function render()
    {   $startDate = Carbon::parse($this->startDate)->startOfDay();
        $endDate = Carbon::parse($this->endDate)->endOfDay();
        //Expense
        $totalAmountRenewStock =RenewStockProduct::whereBetween('created_at', [$startDate, $endDate])->sum('total_amount');
        $totalAmountAddStock =AddStockProduct::whereBetween('created_at', [$startDate, $endDate])->sum('total_amount');
        $totalAmountExpense = $totalAmountAddStock + $totalAmountRenewStock;
        //Revenue
        $totalAmountDirectlyBuy =DirectlyBuy::whereBetween('created_at', [$startDate, $endDate])->sum('total_amount');
        $totalAmountOrderProduct=  OrderProduct::where('status','confirm')->whereBetween('created_at', [$startDate, $endDate])->sum('total_amount');
        $totalAmountRevenue = $totalAmountDirectlyBuy + $totalAmountOrderProduct;
        //Profits
        $totalAmountProfit = $totalAmountRevenue - $totalAmountExpense;
        $totalUser = User::where('role',0)->count('id');
        $totalProduct = Product::count('id');
        $quantitiesByBrand = Product::select('brand_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('brand_id')
        ->get();

    $quantitiesByCategory = Product::select('productcategory_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('productcategory_id')
        ->get();



        return view('livewire.pages.admin.report.report-component',['totalAmountExpense' => $totalAmountExpense,'totalAmountRevenue'=>$totalAmountRevenue,'totalAmountProfit'=>$totalAmountProfit,'totalUser'=>$totalUser,'totalProduct'=>$totalProduct,'quantitiesByCategory'=>$quantitiesByCategory,'quantitiesByBrand'=>$quantitiesByBrand]);
    }
}
