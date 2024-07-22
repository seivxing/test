<?php

namespace App\Livewire\Pages\Admin\Product;

use Livewire\Component;
use App\Models\ProductBrand;
class ProductBrandComponent extends Component
{
    public $brand_id;
    public function deleteProductBrand($brand_id){
        $this->brand_id = $brand_id;
    }
    public function destroyProductBrand(){
        $brand = ProductBrand::find($this->brand_id);
        $brand->delete();
        session()->flash('message','ProductBrand ');
        $this->dispatch('close-modal');
    }
    public function render()
    {
        $brands = ProductBrand::orderBy('id', 'ASC')->paginate(5);
        return view('livewire.pages.admin.product.productbrand.product-brand-component',['brands'=>$brands]);
    }
}
