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
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <form id="filter" action="{{ action('OrdersController@index') }}" method="get">
                                {{ csrf_field() }}


                                <select class="form-control" name="status">
                                        @foreach(\App\Helpers\Constant\OrderStatus::generateSelectList() as $key => $status)
                                            <option value="{{ $key }}" {{ ( $key == Request::get('status') ) ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach

                                </select>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Process Date</th>
                            <th>Created Date</th>
                            <th></th>
                        </tr>

                        @foreach($orders as $key => $order)
                        <tr>
                            <td>{{ (($orders->currentPage() - 1) * $orders->perPage()) + $key + 1 }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->user->company }}</td>
                            <td>{!! \App\Helpers\Constant\OrderStatus::generateIcon($order->status) !!}</td>
                            <td>{{ $order->total }} GBP</td>
                            <td>{{ dates_format($order->process_date) }}</td>
                            <td>{{ dates_format($order->created_at, true) }}</td>
                            <td><a href="{{ action('OrdersController@detail', $order->uuid) }}" class="btn btn-block btn-primary">Manage</a></td>
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

@section('internal_js_script')
<script type="text/javascript">
    $(document).ready(function () {
        $("#filter select[name='status']").on('change', function () {
            $("#filter").submit();
        });
    });
</script>
@endsection