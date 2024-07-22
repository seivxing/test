<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;
use App\Models\ProductBrand;
class AddStockProduct extends Model
{
    use HasFactory;
    protected $table = 'add_stock_product';
    protected $fillable = [
        'productcategory_id',
        'brand_id',
        'model',
        'price',
        'gpu',
        'cpu',
        'ram',
        'quantity',
        'color',
        'display',
        'weight',
        'battery',
        'official_warranty',
        'image',
        'total_amount',
        'description',
    ];
    public function productcategory(){
        return $this->belongsTo(ProductCategory::class,'productcategory_id','id');
    }
    public function productbrand(){
        return $this->belongsTo(ProductBrand::class,'brand_id','id');
    }
}
