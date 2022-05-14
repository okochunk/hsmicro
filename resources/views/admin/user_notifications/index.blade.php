@extends('layouts.auth.customer-master')

@section('content-title')
    {{ 'List Of Notification' }}
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <h3 class="box-title">Notification</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <a href="{{ action('UserNotificationController@create') }}" class="btn btn-block btn-success">Create +</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Is Active</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Created Date</th>
                            <th colspan="2">
                                <form id="filter" action="{{ action('UserNotificationController@index') }}" method="get">
                                    {{ csrf_field() }}
                                    <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}" placeholder="search title">
                                </form>
                            </th>
                        </tr>

                        @foreach($user_notifications as $key => $user_notification)
                        <tr>
                            <td>{{ (($user_notifications->currentPage() - 1) * $user_notifications->perPage()) + $key + 1 }}</td>
                            <td>{{ $user_notification->title }}</td>
                            <td>{{ $user_notification->description }}</td>
                            <td>{!! generateActiveIcon($user_notification->is_active) !!}</td>
                            <td>{{ dates_format($user_notification->start_date) }}</td>
                            <td>{{ dates_format($user_notification->end_date) }}</td>

                            <td>{{ dates_format($user_notification->created_at, true) }}</td>

                            <td><a href="{{ action('UserNotificationController@edit', $user_notification->id) }}" class="btn btn-block btn-warning">Edit</a></td>
                            <td>
                                <form action="{{ action('UserNotificationController@destroy', $user_notification->id) }}" method="post">
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
                        {{ $user_notifications->appends(['status' => Request::get('status')])->links() }}
                    </ul>
                    <small class="text-muted">
                    {{ $user_notifications->count() }} of {{ $user_notifications->total() }} order
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