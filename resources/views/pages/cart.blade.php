@extends('layouts.app')

@section('content')
<div class="main">

    <div id="main" class="has-padding">
        <div class="container">
            @include('partials.messages')
            <h2 class="page-title">@lang('product::order.your_cart')</h2>
            <div class="row">
                <div class="col-sm-9">
                    @if( !Cart::isEmpty() )
                        <form action="{{ route('cart.update') }}" method="post">
                            {{ csrf_field() }}
                            <div class="table-responsive">
                                <table class="table table-bordered" style="background: #FFF">
                                    <thead>
                                    <tr>
                                        <th>@lang('product::order.products')</th>
                                        <th width="100">@lang('product::order.quantity')</th>
                                        <th>@lang('product::order.price')</th>
                                        <th>@lang('product::order.sub_total')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( Cart::getContent() as $key => $product )
                                        <tr>
                                            <td align="top">

                                                <div class="p-cart-info">
                                                    <a href="{{ route('product.detail', [ 'id' => $key, 'slug' => $product['attributes']['slug'] ]) }}">
                                                        {{ $key }}
                                                    </a> <button class="btn btn-sm btn-danger" type="submit" name="remove"  value="{{ $key }}" class="">
                                                        <i class="far fa-trash-alt"></i> </button>
                                                    <p class="mb-0"><small>{{ $product['name'] }}</small></p>

                                                </div>

                                            </td>
                                            <td>
                                                <div class="input-group text-center">
                                                    <input name="quantity[{{ $key }}]" type="number"
                                                           value="{{  $product['quantity'] }}" max="100"
                                                           min="1" class="form-control text-center" />
                                                </div>
                                            </td>
                                            <td>
                                                <strong class="price">{{ number_format($product['price']).config('app.price_suffix') }}</strong>
                                            </td>
                                            <td>
                                                <strong class="price">{{ number_format($product['price'] * $product['quantity']).config('app.price_suffix') }}</strong>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <button name="action" type="submit" class="btn btn-success" value="update_cart">
                                                <i class="fa fa-save"></i> @lang('product::order.update_cart')</button>
                                            <button name="action" type="submit" class="btn btn-danger" value="clean_cart">
                                                <i class="fa fa-trash-o"></i> @lang('product::order.clear_cart')</button>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-info">@lang('product::order.empty_cart')</div>
                    @endif
                </div>
                <div class="col-sm-3">

                    @if( !Cart::isEmpty() )
                        <div class="card mb-3">
                            <div class="card-body">
                                @lang('product::order.total'): <strong class="price">{{ number_format(Cart::getTotal()).config('app.price_suffix') }}</strong>
                            </div>
                        </div>

                        <a href="{{ route('cart.checkout') }}" class="btn btn-success btn-block mb-3"> @lang('product::order.payment')</a>


                    @endif
                    <a href="/" class="btn btn-info btn-block"> @lang('product::order.continue_shopping')</a>
                </div>
            </div>




        </div>
    </div>
</div>
@stop
