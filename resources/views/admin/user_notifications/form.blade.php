@section('internal_css_library')
    <link rel="stylesheet" href="{{ asset("/AdminLTE-2.3.11/plugins/select2/select2-bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("/AdminLTE-2.3.11/plugins/datepicker/datepicker3.css") }}">
@endsection

@section('internal_js_library')
    <script src="{{ asset("/AdminLTE-2.3.11/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
@endsection


<form role="form" method="{{ $method }}" action="{{ $action }}">
    {{ csrf_field() }}
    @if ($mode == 'edit')
        {{ method_field('PUT') }}
    @endif
    <div class="box-body">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            <label for="title" class="control-label">Title</label>
            <input id="title" name="title" type="text" class="form-control" value="{{ $user_notification->title }}">
            @if ($errors->has('title'))
                <span class='help-block'> {{ $errors->first('title') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label for="name" class="control-label">Description</label>
            <input id="description" name="description" type="text" class="form-control" value="{{ $user_notification->description }}">
            @if ($errors->has('description'))
                <span class='help-block'> {{ $errors->first('description') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
            <label for="is_active" class="control-label">Is Active</label>
            <select id="is_active" name="is_active" class="select form-control">
                <option value="1" {{ ( 1 == $user_notification->is_active) ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ ( 0 == $user_notification->is_active) ? 'selected' : '' }}>No</option>
            </select>

            @if ($errors->has('is_active'))
                <span class='help-block'> {{ $errors->first('is_active') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
            <label for="name" class="control-label">Start Date</label>
            <input id="start_date" name="start_date" type="text" class="form-control datepicker" value="{{ $user_notification->start_date }}">
            @if ($errors->has('start_date'))
                <span class='help-block'> {{ $errors->first('start_date') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
            <label for="name" class="control-label">End Date</label>
            <input id="end_date" name="end_date" type="text" class="form-control datepicker" value="{{ $user_notification->end_date }}">
            @if ($errors->has('end_date'))
                <span class='help-block'> {{ $errors->first('end_date') }}</span>
            @endif
        </div>


    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

@section('internal_js_script')
    <script type="text/javascript">
        $('.datepicker').on('focus', function(e) {
            e.preventDefault();
            $(this).attr("autocomplete", "off");
        });

        $('.datepicker').datepicker({
            format: 'yyyy/mm/dd',
            todayHighlight:'TRUE',
            autoclose: true,
        });
    </script>
@endsection