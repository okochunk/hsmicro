<form role="form" method="{{ $method }}" action="{{ $action }}">
    {{ csrf_field() }}
    @if ($mode == 'edit')
        {{ method_field('PUT') }}
    @endif
    <div class="box-body">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name" class="control-label">Product Name</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name') ? old('name') : $product->name }}">
            @if ($errors->has('name'))
                <span class='help-block'> {{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('internal_code') ? 'has-error' : '' }}">
            <label for="name" class="control-label">Internal Code</label>
            <input id="internal_code" name="internal_code" type="text" class="form-control" value="{{ old('internal_code') ? old('internal_code') : $product->internal_code }}">
            @if ($errors->has('internal_code'))
                <span class='help-block'> {{ $errors->first('internal_code') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            <label for="category_id" class="control-label">Category</label>
            <select id="category_id" name="category_id" class="select form-control">
                @foreach ($categories as $key => $category)
                    <option value="{{ $key }}" {{ ($key == $product->category_id) ? 'selected' : '' }}> {{ $category }} </option>
                @endforeach
            </select>

            @if ($errors->has('category_id'))
                <span class='help-block'> {{ $errors->first('category_id') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
            <label for="name" class="control-label">Quantity</label>
            <input id="quantity" name="quantity" type="number" class="form-control" value="{{ old('quantity') ? old('quantity') : $product->quantity }}">
            @if ($errors->has('quantity'))
                <span class='help-block'> {{ $errors->first('quantity') }}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
            <label for="name" class="control-label">Price</label>
            <input id="price" name="price"  class="form-control" value="{{ old('price') ? old('price') : $product->price }}">
            @if ($errors->has('price'))
                <span class='help-block'> {{ $errors->first('price') }}</span>
            @endif
        </div>


        <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
            <label for="is_active" class="control-label">Is Active</label>
            <select id="is_active" name="is_active" class="select form-control">
                <option value="1" {{ ( 1 == $product->is_active) ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ ( 0 == $product->is_active) ? 'selected' : '' }}>No</option>
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