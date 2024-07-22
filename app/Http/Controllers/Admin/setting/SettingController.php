<?php

namespace App\Http\Controllers\Admin\setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function introduction_setting(){
        return view('pages.admin.setting.introduction');
    }
    public function user_setting(){
        return view('pages.admin.setting.userSetting');
    }
    public function laptop_setting(){
        return view('pages.admin.setting.laptopSetting');
    }

    public function product_setting(){
        return view('pages.admin.setting.productSetting');
    }



    public function general_setting(){
        return view('pages.admin.setting.generalSetting');
    }
}
