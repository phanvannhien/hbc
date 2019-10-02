@extends('admin.layouts.app')

@section('content')
    <?php

    $status = [
        'waiting' => 'Waiting',
        'paid' => 'Paid',
        'shipping' => 'Shipping',
        'completed' => 'Completed',
        'refund' => 'Refund',
        'cancel' => 'Cancel',
        'fail' => 'Fail'
    ];
    ?>
    <section class="content-header">
        <a href="{{ route('order.index') }}" class="pull-right btn btn-info"><i class="fa fa-list"></i> Back</a>
        <h1>
            Order #{{ $order->id }}
            <span class="label label-info">{{ $order->status }}</span>
        </h1>

    </section>
    <section class="content">

        <div class="row">
            <div class="col-sm-8">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang("product::order.order_information")</h3>
                    </div>
                    <div class="box-body">
                        @lang('product::order.email'): <strong>{{ $order->user->email }} </strong><br>
                        @lang('product::order.name'): <strong>{{ $order->user->name }} </strong><br>
                        @lang('product::order.phone'): <strong>{{ $order->user->phone }}</strong> <br>
                    </div>

                </div>

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang("product::order.shipping_information")</h3>
                    </div>
                    <div class="box-body">
                        @lang('product::order.full_name'): <strong>{{ $order->shipping_full_name }} </strong><br>
                        @lang('product::order.phone'): <strong>{{ $order->shipping_phone }} </strong> <br>
                        @lang('product::order.address'): <strong>{{ $order->shipping_address }}</strong>
                    </div>
                </div>

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('product::order.order_products')</h3>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('order.update', $order->id) }}" method="post">
                            <input type="hidden" name="_method" value="put">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $order->id }}" name="order_id">
                            <table id="tbl-order-detail" class="table table-bordered" style="background-color: #fff;">
                                <thead>
                                <tr>
                                    <td>Product</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                    <td>Sub Total</td>
                                    <td>Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $total = 0 ;  $i = 0;  ?>
                                @foreach( $order->detail as $item )
                                    <tr>
                                        <td><a class="product" target="_blank"
                                               href="{{ route('product.detail', [ 'id' => $item->product->id, 'slug' => $item->product->product_slug ]) }}">
                                                {{$item->product->product_name}}</a>
                                            <span>{{ $item->product_sku }}</span>
                                        </td>
                                        <td><input min="1" max="100" class="qty form-control" value="{{ $item->qty }}" type="number" name="product[{{ $item->product->product_sku }}]"></td>
                                        <td><span class="price">{{ $item->getPriceFormat()  }}</span></td>
                                        <td><span class="sub-total">{{ $item->getSubTotal() }}</span></td>
                                        <td><a href="javascript:;" onclick="$(this).closest('tr').remove()"
                                               class="btn btn-sm btn-warning"><i class="fa fa-trash-o"></i></a></td>
                                    </tr>
                                    <?php  $total += $item->qty * $item->price ; ?>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td>
                                        <select class="select2 form-control" name="product_id" id="sl-product-id">
                                            <?php $products = \Modules\Product\Entities\Products::select('product_name')->get(); ?>
                                            @foreach($products as $p)
                                                <option data-price=""
                                                        data-pricenum = ""
                                                        value="{{ $p->id }}">{{ $p->product_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td colspan="4">
                                        <a name="add_product" class="btn btn-success" id="add-product">Add</a>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                            <p class="clearfix">
                                <button type="submit" name="update_order" class="btn btn-success pull-right">Update</button>
                            </p>
                        </form>
                    </div>
                    <div class="box-footer">
                        <p>Total: {{ number_format($total).config('app.price_suffix')  }}</p>
                    </div>
                </div>




            </div>
            <div class="col-sm-4">
                <h3>Change status</h3>
                <form action="{{ route('admin.order.change_status') }}" method="post">
                    <input type="hidden" value="{{ $order->id }}" name="order_id">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select class="form-control" name="status" name="status" id="">
                            @foreach( $status as $key => $s )
                                <option {{ ( $key == $order->status ) ? 'selected' : '' }}  value="{{ $key }}">{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-danger" type="submit" name="change_order_status">Change</button>
                </form>
            </div>
        </div>



    </section>
    <div id="p-template" style="display: none">
        <tr>
            <td><a id="product" target="_blank" href=""></a></td>
            <td><input id="qty" class="form-control" value="1" type="number" name=""></td>
            <td><span id="price"></span></td>
            <td><span id="sub-total"></span></td>
            <td><a href="javascript:;" onclick="$(this).closest('tr').remove()"
                   class="btn btn-sm btn-warning"><i class="fa fa-trash-o"></i></a></td>
        </tr>
    </div>


    <script>
        {{--$(document).ready(function() {--}}
            {{--$('.select2').select2();--}}
            {{--$('#add-product').on('click', function(e){--}}
                {{--var pid = $("#sl-product-id").select2().find(":selected").val();--}}
                {{--$.ajax({--}}
                    {{--type: 'get',--}}
                    {{--url: "{{ route('admin.product.order') }}",--}}
                    {{--data: { pid: pid },--}}
                    {{--dataType: 'json',--}}
                    {{--success: function( res ){--}}
                        {{--var temp = $('#tbl-order-detail tbody tr:first-child').clone();--}}

                        {{--$(temp).find('.product').text( res.title );--}}
                        {{--$(temp).find('.qty').attr('name','product['+res.id+']').val(1);--}}
                        {{--$(temp).find('.price').text( res.priceText );--}}
                        {{--$(temp).find('.sub-total').text( res.priceText );--}}
                        {{--$('#tbl-order-detail tbody').append(temp);--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}

        {{--});--}}
    </script>

@stop