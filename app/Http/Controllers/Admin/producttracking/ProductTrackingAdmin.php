<?php



namespace App\Http\Controllers\Admin\producttracking;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class ProductTrackingAdmin extends Controller
{
    public function index()
    {
        return view('pages.admin.producttracking.producttracking');
    }




    public function show($orderId)
    {
        // Retrieve the order based on the provided order ID
        $order = OrderProduct::find($orderId);

        // Check if the order exists
        if (!$order) {
            return redirect()->back()->with('message', 'No Order Found');
        }

        // Retrieve the user associated with the order
        $user = User::find($order->user_id);

        return view('pages.admin.producttracking.producttrackingdetail', ['order' => $order, 'user' => $user]);
    }

    public function view_invoice($orderId)
    {
        $order = OrderProduct::find($orderId);
        $user = User::find($order->user_id);
        return view('pages.admin.producttracking.viewinvoice', ['order' => $order, 'user' => $user]);
    }

    public function download_invoice($orderId)
    {
        $order = OrderProduct::find($orderId);
        $user = User::find($order->user_id);
        $data = ['order' => $order, 'user' => $user];
        $pdf = Pdf::loadView('pages.admin.producttracking.viewinvoice', $data);
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'.pdf');
    }
}
