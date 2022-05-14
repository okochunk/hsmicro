<form role="form" method="{{ $method }}" action="{{ $action }}">
    {{ csrf_field() }}
    @if ($mode == 'edit')
        {{ method_field('PUT') }}
    @endif
    <div class="box-body">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name" class="control-label">Name</label>
            <input disabled id="name" name="name" type="text" class="form-control" value="{{ old('name') ? old('name') : $user->name }}">
            @if ($errors->has('name'))
                <span class='help-block'> {{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
            <label for="is_active" class="control-label">Is Active</label>
            <select id="is_active" name="is_active" class="select form-control">
                <option value="1" {{ ( 1 == $user->is_active) ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ ( 0 == $user->is_active) ? 'selected' : '' }}>No</option>
            </select>

            @if ($errors->has('is_active'))
                <span class='help-block'> {{ $errors->first('is_active') }}</span>
            @endif
        </div>


        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label for="email" class="control-label">Email</label>
            <input disabled id="email" name="email" type="text" class="form-control" value="{{ old('email') ? old('email') : $user->email }}">
            @if ($errors->has('email'))
                <span class='help-block'> {{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
            <label for="company" class="control-label">Company</label>
            <input disabled id="company" name="company" type="text" class="form-control" value="{{ old('company') ? old('company') : $user->company }}">
            @if ($errors->has('company'))
                <span class='help-block'> {{ $errors->first('company') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
            <label for="phone" class="control-label">Phone</label>
            <input disabled id="phone" name="phone" type="text" class="form-control" value="{{ old('phone') ? old('phone') : $user->phone }}">
            @if ($errors->has('phone'))
                <span class='help-block'> {{ $errors->first('phone') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('created_at') ? 'has-error' : '' }}">
            <label for="created_at" class="control-label">Created at</label>
            <input disabled id="created_at" name="created_at" type="text" class="form-control" value="{{ old('created_at') ? old('created_at') : $user->created_at }}">
            @if ($errors->has('created_at'))
                <span class='help-block'> {{ $errors->first('created_at') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('updated_at') ? 'has-error' : '' }}">
            <label for="updated_at" class="control-label">Updated at</label>
            <input disabled id="updated_at" name="updated_at" type="text" class="form-control" value="{{ old('updated_at') ? old('updated_at') : $user->updated_at }}">
            @if ($errors->has('updated_at'))
                <span class='help-block'> {{ $errors->first('updated_at') }}</span>
            @endif
        </div>


    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>