<?php
namespace App\Http\Controllers\User\ProductCheckOut;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ProductBrand;
class ProductCheckOutController extends Controller
{
     public function index(){
        $brandnames = ProductBrand::all();
     return view('pages.user.checkoutproduct.index',['brandnames' => $brandnames]);
     }
}
