<?php

namespace App\Http\Controllers\Admin\renewstockproduct;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class RenewStockProductController extends Controller
{
    public function index(){
        return view('pages.admin.renewstockproduct.index');
    }
}
