@extends('layouts.auth.customer-master')

@section('content-title')
    {{ 'List Of Products' }}
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <h3 class="box-title">Orders</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <a href="{{ action('ProductsController@create') }}" class="btn btn-block btn-success">Create +</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Is Active</th>
                            <th>Created Date</th>
                            <th colspan="2">
                                <form id="filter" action="{{ action('ProductsController@index') }}" method="get">
                                    {{ csrf_field() }}
                                <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}" placeholder="search product name">
                                </form>
                            </th>
                        </tr>

                        @foreach($products as $key => $product)
                        <tr>
                            <td>{{ (($products->currentPage() - 1) * $products->perPage()) + $key + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{!! generateActiveIcon($product->is_active) !!}</td>
                            <td>{{ dates_format($product->created_at, true) }}</td>

                            <td><a href="{{ action('ProductsController@edit', $product->id) }}" class="btn btn-block btn-warning">Edit</a></td>
                            <td>
                                <form action="{{ action('ProductsController@destroy', $product->id) }}" method="post">
                                    {{csrf_field()}}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-block btn-danger" onclick="return myFunction();">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        </tbody></table>
                </div>
                <!-- /.box-body -->

                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {{ $products->appends(['status' => Request::get('status')])->links() }}
                    </ul>
                    <small class="text-muted">
                    {{ $products->count() }} of {{ $products->total() }} order
                    </small>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection

@section('internal_js_script')
    <script type="text/javascript">
        function myFunction() {
            if(!confirm("Are You Sure to delete this"))
                event.preventDefault();
        }

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                $("#filter").submit();
            }
        });

    </script>
@endsection