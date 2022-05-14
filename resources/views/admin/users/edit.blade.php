@extends('layouts.auth.customer-master')

@section('content-title')
    {{ '' }}
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit User</h3>
            </div>

            @include('admin.users.form', [
                'action' => action('UsersController@update', $user->id),
                'method' => 'POST',
                'mode' => 'edit'
            ])
        </div>
    </div>
</div>

@endsection