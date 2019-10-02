@extends('layouts.app')

@section('content')
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('partials.sidebar')
                </div>
                <div class="col-sm-9">
                    <h2 class="page-title">@lang('app.search_for'): {{ Request::get('q') }}</h2>
                    <?php
                    $keyword = Request::get('q');


                    ?>
                    @if( $products )

                        <div class="clearfix">

                            @if( $products && count($products))
                                <p class="float-left">@lang('app.showing') {{$products->firstItem()}}-{{$products->lastItem()}} @lang('app.of') {{$products->total()}}
                                    @lang('app.results')</p>

                            @endif
                        </div>
                        @foreach( $products as $product )
                            <?php
                            $str = $product->product_name;
                            $str = str_ireplace($keyword, "<span style='background:yellow'>$keyword</span>", $str);
                            ?>
                                <div class="product-item clearfix">

                                    <div class="p-meta">
                                        <h3 class="p-name"><a href="{{ route('product.detail',[ 'slug'=> $product->product_slug, 'id' => $product->id ]) }}">
                                                {!! $str !!}</a></h3>


                                        <div class="clearfix">
                                            <img src="{{ $product->product_image }}" class="img-thumbnail p-thumb float-left" alt="">
                                            <p class="m-0">
                                                <small class="text-grey">@lang('product::product.product_synonym'):</small> <strong>{{ $product->product_synonym }}</strong>
                                                <br>
                                                <span>
                                        <small class="text-grey">Formula:</small> <strong>{{ $product->product_formular }}</strong> -
                                        <small class="text-grey">Molecular Weight:</small> <strong>{{ $product->product_weight }}</strong> -
                                        <small class="text-grey">CAS Number:</small> <strong><a href="/search-form?q={{ $product->product_cas }}">{{ $product->product_cas }}</a></strong>
                                    </span>

                                            </p>
                                        </div>

                                        <hr>

                                        <div class="clearfix text-center">
                                            <p class="float-left m-0">
                                                <input id="check-item-{{ $product->product_code }}" class="float-left mr-3  add-compare" type="checkbox"
                                                       data-img="{{ $product->product_image }}"
                                                       name="compare[]" value="{{ $product->product_code }}">
                                                <a href="{{ route('product.detail',[ 'slug'=> $product->product_slug, 'id' => $product->id ]) }}" class="float-left mr-3">{{ $product->product_code }}</a>
                                                <span> {{ $product->product_grade.', ' }} {{ $product->product_concentration.', ' }} {{ $product->brand }}</span>
                                            </p>


                                            <a data-toggle="collapse" href="#collapse-{{ $product->product_code }}"
                                               class="float-right">@lang('product::product.pricing') <i class="fas fa-angle-down"></i> </a>

                                        </div>
                                        <div id="collapse-{{ $product->product_code }}" class="p-pricing collapse clearfix">
                                            <form action="{{ route('ajax.addcart') }}" method="post">
                                                {{ csrf_field() }}
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
