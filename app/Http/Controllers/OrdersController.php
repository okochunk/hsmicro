<?php

namespace App\Http\Controllers;

use App\OrderDetail;
use App\Orders;
use Exception;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $orders = Orders::getAllOrder($request)->paginate(config('pagination.admin.per_page'));

        return view('admin/order', compact('orders'));
    }

    public function detail(Request $request)
    {
        $uuid = $request->route('uuid');

        if (empty($uuid)) {
            return abort(404);
        }

        $order = Orders::getOrderByUuid($uuid)->first();

        if (empty($order)) {
            return abort(404);
        }

        $order_detail = OrderDetail::getDetailByOrderid($order->id)->get();

        return view('admin/detail', compact('order_detail', 'order'));

    }

    public function updateStatus(Request $request)
    {
        $uuid = $request->route('uuid');

        if (empty($uuid)) {
            return abort(404);
        }

        $order = Orders::getOrderByUuid($uuid)->first();

        if (empty($order)) {
            return abort(404);
        }

        try {
            Orders::updateStatus($order->id, $request->status);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $notification = [
            'message' => 'Order updated successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.order.detail', ['uuid' => $order->uuid])->with($notification);

    }
}
