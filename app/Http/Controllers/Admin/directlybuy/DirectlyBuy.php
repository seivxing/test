<?php


namespace App\Http\Controllers\Admin\directlybuy;

use  App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DirectlyBuy extends Controller
{
    public function index(){
        return view('pages.admin.directlybuy.directlybuy');
    }
}
