<?php



namespace App\Http\Controllers\Admin\addstockproduct;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AddStockProductController extends Controller
{
    public function  index(){
        return view('pages.admin.addstockproduct.index');
    }
}
