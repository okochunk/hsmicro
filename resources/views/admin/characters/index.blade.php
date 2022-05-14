@extends('layouts.auth.customer-master')

@section('content-title')
    {{ 'Characters' }}
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Characters Count</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                  <div class="form-group">
                      <label for="input1" class="control-label">Input 1 :</label>
                      <span>{{ $input1 }}</span>
                  </div>

                  <div class="form-group">
                      <label for="input2" class="control-label">Input 2 :</label>
                      <span>{{ $input2 }}</span>
                  </div>

                  <div class="form-group">
                      <label for="alphabets" class="control-label">Input 1 Characters in Input 2 Words :</label>
                      <span>{{ json_encode($alphabets, JSON_PRETTY_PRINT) }}</span>
                  </div>

                  <div class="form-group">
                      <label for="percentage" class="control-label">Percentage:</label>
                      <span>{{ $percentage }}%</span>
                  </div>
            </div>
        </div>
    </div>
</div>

@endsection