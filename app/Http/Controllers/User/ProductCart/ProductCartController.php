<?php


namespace App\Http\Controllers\User\ProductCart;

use App\Http\Controllers\Controller;
use App\Models\ProductBrand;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    public function index(){
        $brandnames = ProductBrand::all();
        return view('pages.user.productcart.index',['brandnames'=>$brandnames]);
    }
}
