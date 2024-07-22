<?php





namespace App\Http\Controllers\Admin\orderrecord;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class OrderRecordController extends Controller
{
    public function index(){
        return view('pages.admin.orderrecord.orderrecord');
    }
}
