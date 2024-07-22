<?php
namespace  App\Http\Controllers\User\ProductTracking;
use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductBrand;
class ProductTrackingController extends Controller
{
    public $orderId;

    public function index(){
        $orders = OrderProduct::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        $brandnames = ProductBrand::all();
        return view('pages.user.trackingproduct.index',['orders'=>$orders,'brandnames'=>$brandnames]);

    }

    public function tracking_detail($orderId){
        $brandnames = ProductBrand::all();
        return view('pages.user.trackingproduct.producttracking-detail',['orderId'=>$orderId,'brandnames'=>$brandnames]);
    }
}
