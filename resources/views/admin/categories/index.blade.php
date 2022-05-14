@extends('layouts.auth.customer-master')

@section('content-title')
    {{ 'List Of Categories' }}
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <h3 class="box-title">Orders</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <a href="{{ action('CategoriesController@create') }}" class="btn btn-block btn-success">Create +</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Is Active</th>
                            <th>Created Date</th>
                            <th></th>
                        </tr>

                        @foreach($categories as $key => $category)
                        <tr>
                            <td>{{ (($categories->currentPage() - 1) * $categories->perPage()) + $key + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{!! generateActiveIcon($category->is_active) !!}</td>
                            <td>{{ dates_format($category->created_at, true) }}</td>
                            <td><a href="{{ action('CategoriesController@edit', $category->id) }}" class="btn btn-block btn-warning">Edit</a></td>
                            <td>
                                <form action="{{ action('CategoriesController@destroy', $category->id) }}" method="post">
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
                        {{ $categories->appends(['status' => Request::get('status')])->links() }}
                    </ul>
                    <small class="text-muted">
                    {{ $categories->count() }} of {{ $categories->total() }} order
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
    </script>
@endsection