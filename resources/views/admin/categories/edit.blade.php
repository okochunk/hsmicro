@extends('layouts.auth.customer-master')

@section('content-title')
    {{ '' }}
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @include('admin.categories.form', [
                'action' => action('CategoriesController@update', $category->id),
                'method' => 'POST',
                'mode' => 'edit'
            ])
        </div>
    </div>
</div>

@endsection