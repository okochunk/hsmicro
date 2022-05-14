@extends('layouts.auth.customer-master')

@section('content-title')
    {!! \App\Helpers\Constant\OrderStatus::generateIcon($order->status) !!}
@endsection


@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <h3 class="box-title">Order Detail</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover table-order">
                        <tbody>
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>

                        </tr>

                        @foreach($order_detail as $cart)
                            <tr>
                                <td>{{ $cart->product->name }}</td>
                                <td class="text-center">{{ $cart->quantity }}</td>
                                <td class="text-center">{{ $cart->price }} GBP</td>
                                <td class="text-center">{{ $cart->subtotal }} GBP</td>
                            </tr>
                        @endforeach

                        </tbody>

                        <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-center">Total</td>
                            <td class="text-center">  {{ $order->total }} GBP </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endsection