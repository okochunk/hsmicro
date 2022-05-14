@extends('layouts.auth.customer-master')

@section('content-title')
    {{ '' }}
@endsection

@section('internal_css_library')
    <link rel="stylesheet" href="{{ asset("/AdminLTE-2.3.11/plugins/select2/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/AdminLTE-2.3.11/plugins/select2/select2-bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("/AdminLTE-2.3.11/plugins/datepicker/datepicker3.css") }}">
@endsection

@section('internal_js_library')
    <script src="{{ asset("/AdminLTE-2.3.11/plugins/select2/select2.min.js") }}"></script>
    <script src="{{ asset("/AdminLTE-2.3.11/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
@endsection

<style>
    .row-new {
        display: none;
    }
</style>

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Order Form</h3>
                    <i class="fa fa-fw fa-pencil-square"></i>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{ action('Customer\OrderController@postCart') }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('product') ? 'has-error' : '' }}">
                            <label for="">Product Name</label>

                            <select name="product" id="product" class="form-control product-select2 product-form" width="100%">
                                @foreach($products as $key => $product)
                                    <option value="{{ $key }}">{{ $product }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                            <label for="">Quantity</label>
                            <input name="quantity" type="number" class="form-control"  value="1" min="1" max="100">
                            @if( $errors->has('quantity') )
                                <span class='help-block'> {{ $errors->first('quantity') }}</span>
                            @endif
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-add-row">Add <i class="fa fa-fw fa-plus"></i> </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title"> Order Summary</h3>
                    <i class="fa fa-fw fa-shopping-cart"></i>
                </div>
                <table class="table table-striped table-hover table-order">
                    <tbody>
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th></th>
                    </tr>

                    @foreach(Cart::content() as $cart)
                        <tr>
                            <td>{{ $cart->name }}</td>
                            <td class="text-center">{{ $cart->qty }}</td>
                            <td class="text-center">{{ $cart->price }} GBP</td>
                            <td class="text-center">{{ $cart->subtotal }} GBP</td>
                            <td class="text-center">
                                <button type="submit" class="btn btn-primary btn-delete-row" data-id="{{ $cart->rowId  }}" data-url="{{ action('Customer\OrderController@productDestroy', [$cart->rowId]) }}"> Remove <i class="fa fa-fw fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-center">Total</td>
                            <td class="text-center">

                                {{ Cart::total() }} GBP
                            </td>
                        </tr>
                    </tfoot>
                </table>

                @if (Cart::content()->count() > 0)
                <form role="form" method="post" action="{{ action('Customer\OrderController@store') }}">
                    {{ csrf_field() }}
                    <div class="box-footer">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
                                <label for="">Order Notes</label>
                                <input name="notes" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('process_date') ? 'has-error' : '' }}">
                                <label for="">Order Process Date</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="process_date" type="text" class="form-control pull-right" id="datepicker" value="{{ $default_date->format('Y/m/d') }}">
                                </div>

                                @if( $errors->has('process_date') )
                                    <span class='help-block'> {{ $errors->first('process_date') }}</span>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-warning btn-add-row">Submit Order <i class="fa fa-fw fa-plus"></i> </button>
                    </div>
                </form>
                @endif

            </div>
        </div>
    </div>
@endsection

@section('internal_js_script')
<script type="text/javascript">



    $(document).ready(function() {

        $('.product-select2').select2({
            theme:'bootstrap',
            delay: 10,
            minimumInputLength: 3
        });

        $('#datepicker').on('focus', function(e) {
            e.preventDefault();
            $(this).attr("autocomplete", "off");
        });

        $('#datepicker').datepicker({
            format: 'yyyy/mm/dd',
            startDate: '+1d',
            daysOfWeekDisabled: '0',
            todayHighlight:'TRUE',
            autoclose: true,
        });

        // $('#datepicker').datepicker('setDate', '2');


        $('.table').on('click', '.btn-delete-row', function () {
            var id = $(this).data('id');
            var target = $(this);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.value) {

                    var url = target.data('url');
                    $(location).attr('href',url);

                }
            })



        });

    });
</script>
@endsection