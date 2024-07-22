<?php

namespace App\Livewire\Pages\Admin\Product;

use Livewire\Component;
use App\Models\ProductCategory;

class ProductCategoryComponent extends Component
{
    public $productcategory_id;
    public function deleteProductCategory($productcategory_id){
        $this->productcategory_id = $productcategory_id;
    }
    public function destroyProductCategory(){
        $productcategory = ProductCategory::find($this->productcategory_id);
        $productcategory->delete();
        session()->flash('message','ProductCategory');
        $this->dispatch('close-modal');
    }

    public function render()
    {
        $productcategory = ProductCategory::orderBy('id','ASC')->paginate(5);
        return view('livewire.pages.admin.product.productcategory.product-category-component',['productcategory'=>$productcategory]);
    }
}
