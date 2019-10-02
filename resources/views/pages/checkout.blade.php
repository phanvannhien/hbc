@extends('layouts.app')

@section('content')
<div class="main">
    <div id="main" class="has-padding">
        <div class="container">
            @include('partials.messages')
            <h2 class="page-title">@lang('product::order.your_cart')</h2>
            <div class="row">
                <div class="col-sm-8">
                    @if( !Auth::check() )
                    <div class="card">
                        <div class="card-header">
                            @lang('product::customer.account')
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p> @lang('product::customer.register')</p>
                                    @include('partials.frm_register')

                                </div>
                                <div class="col-6">
                                    <p> @lang('product::customer.have_account')</p>
                                    @include('partials.frm_login')
                                </div>
                            </div>
                        </div>
                    </div>

                    @else

                        <form action="{{ route('cart.purchase') }}" method="post">
                            {{ csrf_field() }}

                            @if( Auth::user()->addressBook->count() )
                            <label for="">@lang('product::order.select_address')</label>
                            <div id="exist-address" class="collapse show">
                                <div class="form-group">
                                    <select name="address_id" class="list-address-book form-control" >
                                        <option {{ (old('address_id') == -1)?'selected':'' }} value="-1">@lang('app.select')</option>
                                        <option {{ (old('address_id') == 0)?'selected':'' }} value="0">@lang('product::order.new_address')</option>
                                        @foreach( Auth::user()->addressBook as $address )
                                            <option {{ (old('address_id') == $address->id )?'selected':'' }} value="{{ $address->id }}">
                                                {{ $address->address }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @else
                                <select class="hidden" name="address_id" id="" hidden>
                                    <option value="0" selected></option>
                                </select>
                            @endif

                            <div id="new-address" class="collapse">
                                <div class="form-group">
                                    <lalel>@lang('product::order.full_name') <span class="require">*</span></lalel>
                                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}">
                                </div>
                                <div class="form-group">
                                    <lalel>@lang('product::order.phone') <span class="require">*</span></lalel>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                </div>
                                <div class="form-group">
                                    <lalel>@lang('product::order.address') <span class="require">*</span></lalel>
                                    <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">@lang('product::order.note')</label>
                                <textarea name="note" id="" class="form-control" cols="30" rows="3">{{ old('note') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success" name="submit">@lang('product::order.checkout')</button>


                        </form>

                    @endif




                </div>
                <div class="col-sm-4">

                    @if( !Cart::isEmpty() )



                        <div class="card mb-3">
                            <div class="card-body">
                                <table class="">
                                    <thead>
                                        <tr class="border-bottom mb-2">
                                            <td>@lang('product::order.products')</td>
                                            <td>@lang('product::order.price')</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( Cart::getContent() as $key => $product )

                                        <tr>
                                            <td align="top">
                                                <div class="mt-3"></div>
                                                <a class="" href="{{ route('product.detail', [ 'id' => $key, 'slug' => $product['attributes']['slug'] ]) }}">
                                                    {{ $key }}
                                                </a>
                                                <br>
                                                {{ $product['name'] }}
                                                <br>
                                                <small class="text-danger">
                                                <span class="price">{{ number_format($product['price']).config('app.price_suffix') }}</span>x
                                                <span>{{  $product['quantity'] }}</span>
                                                </small>

                                            </td>
                                            <td>
                                                <strong class="price">{{ number_format($product['price'] * $product['quantity']).config('app.price_suffix') }}</strong>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <div class="card-footer">
                                @lang('product::order.total'): <strong class="price">{{ number_format(Cart::getTotal()).config('app.price_suffix') }}</strong>
                            </div>
                        </div>

                        <a href="{{ route('cart.viewcart') }}" class="btn btn-success btn-block mb-3"> @lang('product::order.edit_order')</a>

                    @endif
                    <a href="/" class="btn btn-info btn-block"> @lang('product::order.continue_shopping')</a>
                </div>
            </div>




        </div>
    </div>
</div>
@stop

