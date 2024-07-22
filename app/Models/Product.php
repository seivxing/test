<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
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
        'description',
    ];

    public function productcategory(){
        return $this->belongsTo(ProductCategory::class,'productcategory_id','id');
    }

    public function productbrand(){
        return $this->belongsTo(ProductBrand::class,'brand_id','id');
    }
}
