@extends('layouts.auth.customer-master')

@section('content-title')
    {{ 'List Of Order' }}
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <h3 class="box-title">Orders</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a href="{{ action('Customer\OrderController@create') }}" class="btn btn-block btn-success">Create +</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th>Total</th>
                            <th></th>
                            <th></th>
                        </tr>

                        @foreach($orders as $key => $order)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ dates_format($order->process_date) }}</td>
                            <td>{!! \App\Helpers\Constant\OrderStatus::generateIcon($order->status) !!}</td>
                            <td>{{ $order->notes }}</td>
                            <td>{{ $order->total }} GBP</td>
                            <td><a href="{{ action('Customer\OrderController@detail', $order->uuid) }}" class="btn btn-block btn-primary">View</a></td>
                            <td><a href="{{ action('Customer\OrderController@repeatOrder', $order->uuid) }}" class="btn btn-block btn-success">Repeat Order</a></td>
                        </tr>
                        @endforeach

                        </tbody></table>
                </div>
                <!-- /.box-body -->

                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {{ $orders->appends(['status' => Request::get('status')])->links() }}
                    </ul>
                    <small class="text-muted">
                        {{ $orders->count() }} of {{ $orders->total() }} order
                    </small>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>



@endsection