<?php

use App\Http\Controllers\Admin\accessory\AccessoryController;
use App\Http\Controllers\Admin\category\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\laptop\LaptopController;
use App\Http\Controllers\Admin\setting\SettingController;
use App\Http\Controllers\Admin\tracking\TrackingAdmin;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AllCategoryController;
use App\Http\Controllers\User\Cart\CartController;
use App\Http\Controllers\User\CheckOut\CheckOutController;
use App\Http\Controllers\User\Tracking\TrackingController;
use App\Http\Controllers\Admin\addstocklaptop\AddStockLaptopController;
use App\Http\Controllers\Admin\renewstocklaptop\RenewStockLaptopController;
use App\Models\AddLaptopStock;
use App\Http\Controllers\Admin\sale\SaleController;

use App\Models\Laptop;
use App\Http\Controllers\Admin\product\ProductController;
use App\Http\Controllers\Admin\product\ProductBrandController;
use App\Http\Controllers\Admin\product\ProductCategoryController;
use App\Http\Controllers\Admin\addstockproduct\AddStockProductController;
use App\Http\Controllers\User\ProductCheckOut\ProductCheckOutController;
use App\Http\Controllers\Admin\renewstockproduct\RenewStockProductController;
use App\Http\Controllers\User\ProductCart\ProductCartController;
use App\Http\Controllers\User\ProductTracking\ProductTrackingController;
use App\Http\Controllers\Admin\producttracking\ProductTrackingAdmin;
use App\Http\Controllers\Admin\directlybuy\DirectlyBuy;
use App\Http\Controllers\Admin\orderrecord\OrderRecordController;
use App\Http\Controllers\Admin\salerecord\SaleRecordController;
use App\Http\Controllers\Admin\slider\SliderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/category/{category}', [AllCategoryController::class, 'show'])->name('category.show');
Route::get('/brand/{brand}', [AllCategoryController::class, 'productshow'])->name('brand.show');

Route::get('/viewdetail/product/{model}',[AllCategoryController::class, 'viewdetailproduct'])->name('viewdetailproduct');



Route::get('/trackingproduct',[ProductTrackingController::class,'index'])->name('tracking_product');

Route::get('/trackingproduct/{orderId}',[ProductTrackingController::class,'tracking_detail'])->name('trackingproduct_detail');





//---------------------------------------------------------------------------------------------------------------------------//
//Route Register
// Route::get('/register', [AuthController::class, 'register'])->name('register');
// Route::post('/register/submit', [AuthController::class, 'register_submit'])->name('register_submit');
Route::get('/register',function(){
    return view('auth.Register');
})->name('register');
//Route Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/submit', [AuthController::class, 'login_submit'])->name('login_submit');
//Route Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
//---------------------------------------------------------------------------------------------------------------------------//

//Route Admin
Route::prefix('admin')->middleware(['auth', 'check.role:1'])->group(function () {
    // Admin routes...
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    //User Directly Buy /TODO:Modify by admin
    Route::get('/sale',[SaleController::class,'index'])->name('sale');

    //Slider
    Route::get('sliders',[SliderController::class,'index'])->name('slider_index');
    Route::get('sliders/create',[SliderController::class,'create'])->name('slider_create');
    Route::post('sliders/store',[SliderController::class,'store'])->name('slider_store');
    Route::get('sliders/{slider}/edit',[SliderController::class,'edit'])->name('slider_edit');
    Route::put('sliders/{slider}',[SliderController::class,'update'])->name('slider_update');

    //OrderRecordQuantity
    Route::get('/orderrecord',[OrderRecordController::class,'index'])->name('order_record_quantity');
    //SaleRecord Quantity
    Route::get('/salerecord',[SaleRecordController::class,'index'])->name('sale_record_quantity');

    //Setting
    Route::get('/setting/introduction', [SettingController::class, 'introduction_setting'])->name('introduction_setting');
    Route::get('/setting/user', [SettingController::class, 'user_setting'])->name('user_setting');
    Route::get('/setting/laptop', [SettingController::class, 'laptop_setting'])->name('laptop_setting');
    //TODO: new route product setting
    Route::get('/setting/product', [SettingController::class, 'product_setting'])->name('product_setting');
    Route::get('/setting/accessory', [SettingController::class, 'accessory_setting'])->name('accessory_setting');
    Route::get('/setting/general', [SettingController::class, 'general_setting'])->name('general_setting');

    //Tracking


    //Product
    Route::get('/producttracking',[ProductTrackingAdmin::class,'index'])->name('producttracking_index');
    Route::get('/detail/{orderId}',[ProductTrackingAdmin::class,'show'])->name('trackingproductadmin');
    Route::get('/detail/invoice/{orderId}',[ProductTrackingAdmin::class,'view_invoice'])->name('view_invoice');
    Route::get('/detail/invoice/{orderId}/generate',[ProductTrackingAdmin::class,'download_invoice'])->name('download_invoice');

    //Laptop Stock Management



    //productbrand
    Route::get('/productbrand/create',[ProductBrandController::class,'create'])->name('productbrand_create');
    Route::get('/productbrand/index',[ProductBrandController::class, 'index'])->name('productbrand_index');
    Route::post('/productbrand/store',[ProductBrandController::class, 'store'])->name('productbrand_store');
    Route::get('/productbrand/{brands}/edit',[ProductBrandController::class, 'edit'])->name('productbrand_edit');
    Route::put('/productbrand/{brands}',[ProductBrandController::class,'update'] )->name('productbrand_update');



    //productCategory
    Route::get('/productcategory/create',[ProductCategoryController::class, 'create'])->name('productcategory_create');
    Route::get('/productcategory/index',[ProductCategoryController::class, 'index'])->name('productcategory_index');
    Route::post('/productcategory/store',[ProductCategoryController::class, 'store'])->name('productcategory_store');
    Route::get('/productcategory/{productcategory}/edit',[ProductCategoryController::class, 'edit'])->name('productcategory_edit');
    Route::put('/productcategory/{productcategory}',[ProductCategoryController::class,'update'])->name('productcategory_update');



     //Product
    Route::get('/product/index',[ProductController::class, 'index'])->name('product_index');
    Route::get('/product/create',[ProductController::class,'create'])->name('product_create');
    Route::post('/product/store',[ProductController::class,'store'])->name('product_store');

    //Stock Product
    Route::get('/addstockpoduct/index',[AddStockProductController::class,'index'])->name('addstockproduct');
    Route::get('/renewstockpoduct/index',[RenewStockProductController::class,'index'])->name('renewstockproduct');

    //Qr code
    // Route::get('setting/qrcode/create',[])

});
//---------------------------------------------------------------------------------------------------------------------------//
//Route sale
Route::prefix('sale')->middleware(['auth', 'check.role:2'])->group(function () {
  
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard_sale');

    //User Directly Buy /TODO:Modify by admin
    Route::get('/sale',[SaleController::class,'index'])->name('sale_sale');

    //Slider
    Route::get('sliders',[SliderController::class,'index'])->name('slider_index_sale');
    Route::get('sliders/create',[SliderController::class,'create'])->name('slider_create_sale');
    Route::post('sliders/store',[SliderController::class,'store'])->name('slider_store_sale');
    Route::get('sliders/{slider}/edit',[SliderController::class,'edit'])->name('slider_edit_sale');
    Route::put('sliders/{slider}',[SliderController::class,'update'])->name('slider_update_sale');


    //ProductTracking
    Route::get('/producttracking',[ProductTrackingAdmin::class,'index'])->name('producttracking_index_sale');
    Route::get('/detail/{orderId}',[ProductTrackingAdmin::class,'show'])->name('trackingproductadmin_sale');
    Route::get('/detail/invoice/{orderId}',[ProductTrackingAdmin::class,'view_invoice'])->name('view_invoice_sale');
    Route::get('/detail/invoice/{orderId}/generate',[ProductTrackingAdmin::class,'download_invoice'])->name('download_invoice_sale');

    //Laptop Stock Management



    //productbrand
    Route::get('/productbrand/create',[ProductBrandController::class,'create'])->name('productbrand_create_sale');
    Route::get('/productbrand/index',[ProductBrandController::class, 'index'])->name('productbrand_index_sale');
    Route::post('/productbrand/store',[ProductBrandController::class, 'store'])->name('productbrand_store_sale');
    Route::get('/productbrand/{brands}/edit',[ProductBrandController::class, 'edit'])->name('productbrand_edit_sale');
    Route::put('/productbrand/{brands}',[ProductBrandController::class,'update'] )->name('productbrand_update_sale');



    //productCategory
    Route::get('/productcategory/create',[ProductCategoryController::class, 'create'])->name('productcategory_create_sale');
    Route::get('/productcategory/index',[ProductCategoryController::class, 'index'])->name('productcategory_index_sale');
    Route::post('/productcategory/store',[ProductCategoryController::class, 'store'])->name('productcategory_store_sale');
    Route::get('/productcategory/{productcategory}/edit',[ProductCategoryController::class, 'edit'])->name('productcategory_edit_sale');
    Route::put('/productcategory/{productcategory}',[ProductCategoryController::class,'update'])->name('productcategory_update_sale');



     //Product
    Route::get('/product/index',[ProductController::class, 'index'])->name('product_index_sale');
    Route::get('/product/create',[ProductController::class,'create'])->name('product_create_sale');
    Route::post('/product/store',[ProductController::class,'store'])->name('product_store_sale');

    //Stock Product
    Route::get('/addstockpoduct/index',[AddStockProductController::class,'index'])->name('addstockproduct_sale');
    Route::get('/renewstockpoduct/index',[RenewStockProductController::class,'index'])->name('renewstockproduct_sale');

    //Qr code
    // Route::get('setting/qrcode/create',[])

});
//---------------------------------------------------------------------------------------------------------------------------//

//Route User
Route::prefix('user')->middleware(['auth', 'check.role:0'])->group(function () {
    // User routes...

    //product
    Route::get('/viewproductcart',[ProductCartController::class,'index'])->name('view_productcart');
    Route::get('/checkoutproduct',[ProductCheckOutController::class,'index'])->name('checkout_product');

});
//---------------------------------------------------------------------------------------------------------------------------//
// Prevent Access Login / Register after authentication

Route::get('/login', function() {
    if(Auth::check()) {
        if(Auth::user()->role == 1) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('home');
        }

    } else {
        return view('auth.login');
    }
})->name('login');

Route::get('/register', function() {
    if(Auth::check()) {
        if(Auth::user()->role == 1) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('home');
        }
    } else {
        return view('auth.register');
    }
})->name('register');

