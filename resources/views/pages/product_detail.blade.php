@extends('layouts.app')

@section('content')
    <div class="main">
        <div id="product-detail" class="container">
            <div class="row">
                <div class="col-md-3 d-none d-md-block">
                    @include('partials.sidebar')
                </div>
                <div class="col-md-9">

                    @if( $product->product_type == 'chatchuan' || $product->product_type == 'hoachat' )
                    <h2 class="page-title">{{ $product->product_name }}</h2>
                    <div class="card mb-3">
                        <div class="card-body">
                            @if( $product->product_image != '' )
                            <img width="300" src="{{ $product->product_image }}" class="img-thumbnail p-thumb float-right" alt="">
                            @endif
                            <div>
                                <p class="m-0">
                                    @if( trim($product->product_synonym) != '' )
                                    <small class="text-grey">@lang('product::product.product_synonym'):</small> <strong>{{ $product->product_synonym }}</strong>
                                    @endif
                                    <span>
                                        @if( trim($product->product_formular) != '' )
                                            <small class="text-grey">Formula:</small> <strong>{{ $product->product_formular }}</strong> -
                                        @endif

                                        @if( trim($product->product_weight) != '' )
                                            <small class="text-grey">Molecular Weight:</small> <strong>{{ $product->product_weight }}</strong> -
                                        @endif
                                        @if( trim($product->product_cas) != '' )
                                            <small class="text-grey">CAS Number:</small> <strong><a href="/search-form?q={{ $product->product_cas }}">{{ $product->product_cas }}</a></strong>
                                        @endif
                                    </span>

                                </p>
                            </div>

                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-5">
                            @if( $product->product_image != '' )
                            <img width="300" src="{{ $product->product_image }}" class="img-thumbnail p-thumb float-right" alt="">
                            @endif
                        </div>
                        <div class="col-md-7">
                            <h2 class="page-title">{{ $product->product_name }}</h2>
                            
                            @if( trim($product->product_code) != '' )
                            <p class="mb-0">
                                    <small class="text-grey">Product Code:</small> 
                                    <strong>{{ $product->product_code }}</strong>
                            </p>
                            @endif
                            @if( trim($product->country_of_origin) != '' )
                            <p class="mb-0">
                                    <small class="text-grey">@lang('product::product.country_of_origin'):</small> 
                                    <strong>{{ $product->country_of_origin }}</strong>
                            </p>
                            @endif
                            @if( trim($product->brand) != '' )
                            <p class="mb-0">
                                    <small class="text-grey">@lang('product::product.brand'):</small> 
                                    <strong>{{ $product->brand }}</strong>
                            </p>
                            @endif
                        </div>
                    </div>
                    @endif
                    <p></p>
                    <form class="clearfix" action="{{ route('ajax.addcart') }}" method="post">
                        {{ csrf_field() }}

                        @if( $product->product_type == 'chatchuan' || $product->product_type == 'hoachat' )
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>@lang('product::product.product_sku')</td>
                                <td>@lang('product::product.availability')</td>
                                <td>@lang('product::product.price')</td>
                                <td>@lang('product::product.quantity')</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $product->attributes as $attr )
                                <tr>
                                    <td>{{ $attr->sku }}</td>
                                    <td>{{ $attr->availability }}</td>
                                    <td>{{ number_format($attr->price).config('app.price_suffix') }}</td>
                                    <td>
                                        <input name="qty[{{ $attr->sku }}]" type="number" value="0" min="0" max="500" class="form-control-sm">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @elseif( $product->product_type == 'thietbi' )
                        <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>@lang('product::product.product_sku')</td>
                                    
                                        <td>@lang('product::product.price')</td>
                                        <td>@lang('product::product.quantity')</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $product->attributes as $attr )
                                    <tr>
                                        <td>{{ $attr->sku }}</td>
                                        
                                        <td>{{ $attr->getPriceHtml() }}</td>
                                        <td>
                                            <input name="qty[{{ $attr->sku }}]" type="number" value="0" min="0" max="500" class="form-control-sm">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>@lang('product::product.product_sku')</td>
                                <td>@lang('product::product.volumetric')</td>
                                <td>@lang('product::product.accuracy')</td>
                                <td>@lang('product::product.neck_size')</td>
                                <td>@lang('product::product.price')</td>
                                <td>@lang('product::product.quantity')</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $product->attributes as $attr )
                                <tr>
                                    <td>{{ $attr->sku }}</td>
                                    <td>{{ $attr->attribute_value }}</td>
                                    <td>{{ $attr->accuracy }}</td>
                                    <td>{{ $attr->neck_size }}</td>

                                    <td>{{ number_format($attr->price).config('app.price_suffix') }}</td>
                                    <td>
                                        <input name="qty[{{ $attr->sku }}]" type="number" value="0" min="0" max="500" class="form-control-sm">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @endif
                        <a href="#" class="float-right btn btn-sm btn-primary btn-add-cart-ajax">@lang('app.addcart')</a>
                    </form>

                    <hr>

                    <div class="product-description clearfix">
                        <h3 class="page-title">@lang('product::product.description')</h3>
                        {!! $product->product_description !!}
                        <hr>
                        <p>More detail: <a target="_blank" href="//{!! $product->product_link !!}"> {{ $product->product_link }}</a></p>

                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
