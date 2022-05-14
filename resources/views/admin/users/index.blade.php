@extends('layouts.auth.customer-master')

@section('content-title')
    {{ 'List Of User' }}
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <h3 class="box-title">Users</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;"></div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <form id="filter" action="{{ action('UsersController@index') }}" method="get">
                        <tr>
                            <th>ID</th>
                            <th>
                                Name
                                <input id="name" name="name" type="text" class="form-control" value="{{ Request::get('name') }}" placeholder="search users name">
                            </th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Phone</th>
                            <th>
                                Is Active

                                    <select class="form-control" name="is_active">
                                        <option value="0" {{ (Request::get('is_active') == 0) ? 'selected' : '' }}> Not Active </option>
                                        <option value="1" {{ (Request::get('is_active') == 1) ? 'selected' : '' }}> Active </option>
                                        <option value="all" {{ (Request::get('is_active') == 'all') ? 'selected' : '' }}> All </option>
                                    </select>

                            </th>
                            <th>Created Date</th>
                            <th></th>
                        </tr>
                        </form>

                        @foreach($users as $key => $user)
                        <tr>
                            <td>{{ (($users->currentPage() - 1) * $users->perPage()) + $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->company }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{!! generateActiveIcon($user->is_active) !!}</td>
                            <td>{{ dates_format($user->created_at, true) }}</td>
                            <td><a href="{{ action('UsersController@edit', $user->id) }}" class="btn btn-block btn-primary">Manage</a></td>
                        </tr>
                        @endforeach

                        </tbody></table>
                </div>
                <!-- /.box-body -->

                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        {{ $users->appends(['is_active' => Request::get('is_active')])->links() }}
                    </ul>
                    <small class="text-muted">
                    {{ $users->count() }} of {{ $users->total() }} order
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
        $("select[name='is_active']").on('change', function () {
            $("#filter").submit();
        });
    });

    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            $("#filter").submit();
        }
    });
</script>
@endsection