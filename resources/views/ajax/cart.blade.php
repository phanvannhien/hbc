<div class="py-1 px-3">
@if( !Cart::isEmpty() )
    @foreach( Cart::getContent()->toArray() as $key => $product )
    <div class="mini-cart-item clearfix">
        <a href="{{ route('product.detail', [ 'id' => $key, 'slug' => $product['attributes']['slug'] ]) }}">
            {{ $product['name'] }}
        </a><br>
        <small class="text-danger">{{  $product['quantity'] }} x {{ number_format($product['price']).' '.config('app.price_suffix') }}</small>
    </div>
    @endforeach
    <div class="mini-cart-foot clearfix">
        <hr>
        <div class="">Total: <strong class="price">{{ number_format(Cart::getTotal()).' '.config('app.price_suffix') }}</strong></div>
        <hr>
        <div class="row">
            <div class="col-sm-6"> <a class="btn btn-primary btn-sm pull-left btn-block" href="{{ route('cart.viewcart') }}">
                    @lang('product::order.view_cart')</a></div>
            <div class="col-sm-6"><a class="btn btn-danger btn-sm pull-right btn-block" href="{{ route('cart.checkout') }}">
                    @lang('product::order.payment')</a></div>
        </div>
    </div>

@else
    <p class="m-0">Your cart is empty</p>
@endif
</div>