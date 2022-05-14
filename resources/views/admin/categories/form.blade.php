<form role="form" method="{{ $method }}" action="{{ $action }}">
    {{ csrf_field() }}
    @if ($mode == 'edit')
        {{ method_field('PUT') }}
    @endif
    <div class="box-body">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name" class="control-label">Category Name</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ $category->name }}">
            @if ($errors->has('name'))
                <span class='help-block'> {{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
            <label for="is_active" class="control-label">Is Active</label>
            <select id="is_active" name="is_active" class="select form-control">
                <option value="1" {{ ( 1 == $category->is_active) ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ ( 0 == $category->is_active) ? 'selected' : '' }}>No</option>
            </select>

            @if ($errors->has('is_active'))
                <span class='help-block'> {{ $errors->first('is_active') }}</span>
            @endif
        </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>