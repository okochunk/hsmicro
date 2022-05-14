@extends('layouts.auth.customer-master')

@section('content-title')
    {!! \App\Helpers\Constant\OrderStatus::generateIcon($order->status) !!}
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="box box-solid box-info">
                <div class="box-header text-center">
                    <h3 class="box-title">Name</h3>
                </div>
                <div class="box-body text-center">
                    {{ $order->user->name }}
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="box box-solid box-info">
                <div class="box-header text-center">
                    <h3 class="box-title">Company</h3>
                </div>
                <div class="box-body text-center">
                    {{ $order->user->company }}
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="box box-solid box-info">
                <div class="box-header text-center">
                    <h3 class="box-title">Process Date</h3>
                </div>
                <div class="box-body text-center">
                    {{ dates_format($order->process_date) }}
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="box box-solid box-info">
                <div class="box-header text-center">
                    <h3 class="box-title">Created - Updated Date</h3>
                </div>
                <div class="box-body text-center">
                    {{ dates_format($order->created_at) }} - {{ dates_format($order->updated_at, true) }}
                </div>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="box">
                <div class="box-header"></div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-hover table-order">
                        <tbody>
                        <tr>
                            <th>Internal Code</th>
                            <th>Product</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>

                        </tr>

                        @foreach($order_detail as $cart)
                            <tr>
                                <td>{{ $cart->product->internal_code }}</td>
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

        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <form action="{{ action('OrdersController@updateStatus', [$order->uuid]) }}" method="post">
                        {{ csrf_field() }}
                        <div class="col-xs-6">
                            <select class="form-control" name="status">
                                @foreach(\App\Helpers\Constant\OrderStatus::generateList() as $key => $status)
                                    <option value="{{ $key }}" {{ ( $key == $order->status) ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xs-6">
                            <button class="btn btn-block btn-warning" type="submit"> Update </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    @endsection