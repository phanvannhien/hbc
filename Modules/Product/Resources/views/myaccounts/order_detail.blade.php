@extends('layouts.app')

@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <?php $user = Auth::user() ?>
                <div class="col-sm-3">
                    @include('product::myaccounts.nav')
                </div>
                <div class="col-sm-9">
                    @include('partials.messages')

                    <h2>@lang('product::order.id') #{{ $order->id }}</h2>
                    <p>@lang('product::order.status') <span class="badge badge-pill badge-primary">{{ $order->status }}</span></p>
                    <hr>
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

                    <hr>

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

                    <hr>

                    <h3>@lang('product::order.order_products')</h3>
                    <table class="table table-bordered table-mobile">
                        <thead>
                        <tr>
                            <th>@lang('product::order.products')</th>
                            <th>@lang('product::order.quantity')</th>
                            <th>@lang('product::order.price')</th>
                            <th>@lang('product::order.sub_total')</th>
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

                            </tr>
                            <?php  $total += $item->qty * $item->price ; ?>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" align="right">
                                    @lang('product::order.total'): {{ number_format($total).config('app.price_suffix')  }}
                                </td>
                            </tr>
                        </tfoot>

                    </table>

                </div>
            </div>
        </div>
    </div>
@stop