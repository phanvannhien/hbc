@extends('layouts.app')

@section('content')
<?php
    $arrCompare = Session::has('product_compare') ? Session::get('product_compare') : array();

?>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3 d-none d-md-block">
                @include('partials.sidebar')
            </div>
            <div class="col-md-9">
                <h2 class="page-title">{{ $category->get_trans()->category_name }}</h2>
                <div id="compare-product-wrap" class="border border-primary align-items-stretch p-3 mb-3">
                    <a class="float-right btn btn-success btn-sm" href="{{ route('page.compare.item') }}">@lang('app.compare')</a>
                    <p class="mb-1"><strong class="text-primary">@lang('app.compare_product')</strong> @lang('app.compare_select_upto_4_products')</p>
                    @if( Session::has('product_compare') )
                    <div id="compare-product-items" class="row align-items-stretch justify-content-center">
                        @foreach( Session::get('product_compare') as $item )
                        <div id="{{ $item }}" class="col-md-3 compare-item">
                            <div class="text-center border border-primary">
                                <img src="" alt="">
                                <p><span>{{ $item }}</span></p>
                            </div>
                            <a href="#" data-id="{{ $item }}" class="remove-compare-item"><i class="fa fa-trash"></i></a>
                        </div>
                        @endforeach
                    </div>    
                    @endif
                </div>

                @if( $products )
                    <div class="clearfix">
                        @if( $products && count($products))
                            <p class="float-left">@lang('app.showing') {{$products->firstItem()}}-{{$products->lastItem()}} @lang('app.of') {{$products->total()}}
                                @lang('app.results')</p>
                        @endif
                    </div>
                    @foreach( $products as $product )

                    <div class="product-item clearfix">

                        <div class="p-meta">
                            <h3 class="p-name"><a href="{{ route('product.detail',[ 'slug'=> $product->product_slug, 'id' => $product->id ]) }}">{{ $product->product_name }}</a></h3>


                            <div class="clearfix">
                                @if( trim($product->product_image) != '' )
                                <img src="{{ $product->product_image }}" class="img-thumbnail p-thumb float-left" alt="">
                                @endif
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

                            <hr>
                            
                            <div class="clearfix text-center">
                                <p class="float-left m-0">

                                    <input {{ ( in_array(  $product->product_code,$arrCompare  ) ) ? 'checked' : '' }} id="check-item-{{ $product->product_code }}" class="float-left mr-3  add-compare" type="checkbox"
                                           data-img="{{ $product->product_image }}"
                                           name="compare[]" value="{{ $product->product_code }}">
                                    <a href="{{ route('product.detail',[ 'slug'=> $product->product_slug, 'id' => $product->id ]) }}" class="float-left mr-3">{{ $product->product_code }}</a>

                                        @if( trim($product->product_grade) != '' )
                                        <span>{{ trim($product->product_grade).', ' }}</span>
                                        @endif
                                        @if( trim($product->product_concentration) != '' )
                                            <span>{{ trim($product->product_concentration).', ' }}</span>
                                        @endif
                                        @if( trim($product->brand) != '' )
                                            <span>{{ trim($product->brand) }}</span>
                                        @endif

                                </p>


                                <a data-toggle="collapse" href="#collapse-{{ $product->product_code }}"
                                   class="float-right">@lang('product::product.pricing') <i class="fas fa-angle-down"></i> </a>

                            </div>
                            <div id="collapse-{{ $product->product_code }}" class="p-pricing collapse clearfix">

                                <form action="{{ route('ajax.addcart') }}" method="post">
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
                                                <td>{{ $attr->getPriceHtml() }}</td>
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
                                                <td>{{ $attr->getPriceHtml() }}</td>
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
                            </div>


                        </div>

                    </div>
                    @endforeach
                @endif

                <div class="clearfix d-flex align-items-center justify-content-center">
                    {!! $products->appends(request()->input())->links() !!}
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
