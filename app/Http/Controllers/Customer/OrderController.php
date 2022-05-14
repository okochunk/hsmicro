<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\Constant\OrderStatus;
use App\Mail\OrderCreated;
use App\OrderDetail;
use App\Orders;
use App\Products;
use App\UserNotification;
use Carbon\Carbon;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $notification = UserNotification::where('is_active', true)
            ->where('start_date', '<=', \Carbon\Carbon::today()->toDateString())
            ->where('end_date', '>=', \Carbon\Carbon::today()->toDateString())->first();

        $orders = Orders::getOrderByUserId(Auth::id())->paginate(config('pagination.customer.per_page'));

        return view('customer/order', compact('orders', 'notification'));
    }

    public function create()
    {
        $products = Products::getAllActiveProduct()->get()->pluck('full_product', 'uuid');

        if (Carbon::now()->addDays(2)->format('l') == config('order.exclude_day')) {
            $default_date = Carbon::now()->addDays(2);
        } else {
            $default_date = Carbon::now()->addDays(1);
        }

        return view('customer/create', compact('products', 'default_date'));
    }

    public function postCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product' => 'required',
            'quantity' => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {

            return redirect()->route('cart.create')
                ->withErrors($validator)
                ->withInput();
        }

        $product = Products::getProductByUuid($request->product)->first();

        if (empty($product)) {
            return abort(404);
        }

        Cart::add($product->id, $product->name, $request->quantity, $product->price);

        $notification = array(
            'message' => 'Product added successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('cart.create')->with($notification);
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

        return view('customer/detail', compact('order_detail', 'order'));

    }

    public function repeatOrder(Request $request)
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

        //loop and add to cart redirect to create order page
        foreach($order_detail as $key => $product) {
            Cart::add($product->product_id, $product->product->name, $product->quantity, $product->price);
        }

        $notification = array(
            'message' => 'Product added successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('cart.create')->with($notification);
    }

    public function productDestroy(Request $request)
    {
        $id = $request->route('id');

        if (empty($id)) {
            return redirect()->route('cart.create');
        }

        Cart::remove($id);

        $notification = [
            'message' => 'Product removed successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('cart.create')->with($notification);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'process_date' => 'required'
        ]);

        if ($validator->fails()) {

            return redirect()->route('cart.create')
                ->withErrors($validator)
                ->withInput();
        }

        $content = Cart::content();
        $total  = Cart::total();

        if ($total < config('order.minimum_total_order_price')) {
            $notification = [
                'message' => 'Minimum order is ' . config('order.minimum_total_order_price') . ' GBP, please add more item to your order',
                'alert-type' => 'error'
            ];

            return redirect()->route('cart.create')->with($notification);
        }

        try {

            Orders::createOrder($content, $total, OrderStatus::PENDING, $request, Auth::id());
            Cart::destroy();

            // mail to admin
            $when = Carbon::now()->addMinutes(1);
            Mail::to(config('order.email_admin'))->later($when, new OrderCreated(Auth::user()));

        } catch (Exception $e) {
            return $e->getMessage();
        }

        $notification = [
            'message' => 'Order created successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('order')->with($notification);


    }
}
