@extends('layouts.auth.customer-master')

@section('content-title')
    {{ '' }}
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Product</h3>
            </div>

            @include('admin.products.form', [
                'action' => action('ProductsController@update', $product->id),
                'method' => 'POST',
                'mode' => 'edit'
            ])
        </div>
    </div>
</div>

@endsection