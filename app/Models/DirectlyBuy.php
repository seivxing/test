<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectlyBuy extends Model
{
    use HasFactory;
    protected $table = 'directlybuy';
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
