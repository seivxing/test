<?php

namespace App\Livewire\Pages\Admin\Setting;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Livewire\WithPagination;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
class ProductSetting extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    #[Rule('required|date')]
    public $start_date;
    #[Rule('required|date|after_or_equal:start_date')]
    public $end_date;

    public $search;

    public $perPage = 5;



    public function deleteProducts(){
        if(!empty($this->start_date) && !empty($this->end_date)){
            $start_date = Carbon::parse($this->start_date)->startOfDay();
            $end_date = Carbon::parse($this->end_date)->endOfDay();
            Product::whereBetween('created_at', [$start_date, $end_date])->delete();
        }
    }

    public function resetTable()
    {
        // Laptop::truncate();
        DB::statement('ALTER TABLE products AUTO_INCREMENT = 1;');
    }


    public function render()

    {
          $categories = ProductCategory::all();
        $bradnames = ProductBrand::all();
        $productQuery = Product::when($this->search, function($query) {
            return $query->where('model', 'like', "%$this->search%");
         })
         ->when($this->start_date && $this->end_date, function($query) {
            return $query->whereBetween('created_at', [$this->start_date, $this->end_date]);
         })
         ->orderBy('id', 'ASC');
        $perPage = $this->perPage == 'all' ? $productQuery->count():$this->perPage;
        $products = $productQuery->paginate($perPage);

        return view('livewire.pages.admin.setting.product-setting',['products'=>$products,'brandnames'=>$bradnames,'categories'=>$categories]);
    }
}
