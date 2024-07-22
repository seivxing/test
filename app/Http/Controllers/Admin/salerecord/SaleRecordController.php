<?php
namespace App\Http\Controllers\Admin\salerecord;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SaleRecordController extends Controller
{
    public function index(){
        return view('pages.admin.salerecord.salerecord');
    }
}
