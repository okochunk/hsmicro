<?php

namespace App\Http\Controllers;

use App\Helpers\Constant\OrderStatus;
use App\Orders;
use App\Products;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $new_order = Orders::getDashboard(OrderStatus::PENDING)->count();

        $total_order = Orders::getDashboard(OrderStatus::COMPLETED)->sum('total');

        $user = User::count();

        $product = Products::getAllProduct([])->count();

        return view('admin/dashboard', compact('new_order', 'total_order', 'product', 'user'));
    }
}
