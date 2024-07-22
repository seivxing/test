<?php

namespace App\Http\Controllers\Admin\sale;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        return view('pages.admin.sale.index');
    }
}
