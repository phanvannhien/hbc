@extends('layouts.app')

@section('content')
<div class="main">
    <div class="container">

        <?php
            $class = 'col-md-6 col-lg-3 border p-2';
            if( count($products) == 2 ){
                $class = 'col-md-6 col-lg-6 border p-2';
            }
            if( count($products) == 3 ){
                $class = 'col-md-4 col-lg-4 border p-2';
            }

        ?>

            <div class="row no-gutters align-items-stretch ">

                @foreach( $products as $product )

                    <div class="{{ $class }} " >
                        <img src="{{ $product->product_image }}" class="img-thumbnail p-thumb" alt="">
                        <hr>
                        <h3 class="p-name"><a href="{{ route('product.detail',[ 'slug'=> $product->product_slug, 'id' => $product->id ]) }}">{{ $product->product_name }}</a></h3>
                        <small class="text-grey">Formula:</small> <strong>{{ $product->product_formular }}</strong> <br>
                        <small class="text-grey">Molecular Weight:</small> <strong>{{ $product->product_weight }}</strong> <br>
                        <small class="text-grey">Product code:</small> <strong>{{ $product->product_code }}</strong> <br>
                        <small class="text-grey">Product grade:</small> <strong>{{ $product->product_grade }}</strong> <br>
                        <small class="text-grey">Product concentration:</small> <strong>{{ $product->product_concentration }}</strong> <br>
                        <small class="text-grey">Product brand:</small> <strong>{{ $product->brand }}</strong>
                    </div>
                @endforeach
            </div>
            <div class="row no-gutters align-items-stretch ">
                @foreach( $products as $product )
                <div class="{{ $class }}">
                    <form action="{{ route('ajax.addcart') }}" method="post">
                        {{ csrf_field() }}
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td width="120">@lang('product::product.product_sku')</td>
                                    <td width="100">@lang('product::product.price')</td>
                                    <td width="100">@lang('product::product.quantity')</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $product->attributes as $attr )
                                    <tr>
                                        <td>{{ $attr->sku }}<br>
                                            <small>{{ $attr->availability }}</small></td>

                                        <td>{{ $attr->getPriceHtml() }}</td>
                                        <td>
                                            <input name="qty[{{ $attr->sku }}]" type="number" value="0" min="0" max="500" class="form-control-sm">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="#" class="float-right btn btn-sm btn-primary btn-add-cart-ajax">@lang('app.addcart')</a>
                    </form>
                </div>
                @endforeach
            </div>
            <h4 class="mt-3">Synonyms</h4>
            <div class="row no-gutters align-items-stretch ">

                @foreach( $products as $product )

                    <div class="{{ $class }}" >
                        {{ $product->product_synonym }}
                    </div>
                @endforeach
            </div>
            <h4 class="mt-3">CAS Number</h4>
            <div class="row no-gutters align-items-stretch ">

                @foreach( $products as $product )
                    <div class="{{ $class }}" >
                        {{ $product->product_cas }}
                    </div>
                @endforeach
            </div>

            <h4 class="mt-3">@lang('product::product.description')</h4>
            <div class="row no-gutters align-items-stretch ">

                @foreach( $products as $product )
                    <div class="{{ $class }}" >
                        {!! $product->product_description !!}
                        <hr>
                        <p style="word-break: break-all">More detail: <a target="_blank" href="//{!! $product->product_link !!}"> {{ $product->product_link }}</a></p>
                    </div>
                @endforeach
            </div>





       
    </div>
</div>
@endsection
