<h1>Thanks for your Orders: <a href="{{ route('user.order.detail',$order->id) }}">#{{$order->id}}</a></h1>

<h2>Order Infomations</h2>
<p><b>Receiver Name:</b> {{ $order->fullname }}</p>
<p><b>Receiver Phone:</b> {{ $order->phone }}</p>
<p><b>Shipping address:</b> {{ $order->address }}</p>
<p><b>Status:</b> <strong style="color: red">{{ $order->status }}</strong></p>

<h2>Order information</h2>
<table class="" border="1" style="border: 1px solid #aaa" width="60%">
    <thead>
    <tr>
        <td>Image</td>
        <td>Product</td>
        <td>Price</td>
        <td>Quantity</td>
        <td>Sub total</td>
    </tr>
    </thead>
    <tbody>
    <?php $total = 0; ?>
    @foreach ( $order->detail as $item )
        <tr class="">
            <td class="" style="width:20%">
                <a href="{{ route('product.detail', [ 'id' => $item->product->id, 'slug' => $item->product->slug ]) }}">
                    <img width="80" alt="img" src="{{ $item->product->getThumbnail() }}">
                </a>
            </td>
            <td style="width:40%">
                <h4>
                    <a href="{{ route('product.detail', [ 'id' => $item->product->id, 'slug' => $item->product->slug ]) }}">
                        {{ $item->product->title }} </a>
                </h4>
            </td>
            <td>
                <span style="color: red">{{ number_format($item->price).' '.config('price_suffix') }}</span>
            </td>
            <td class="" style="width:10%">{{ $item->qty }}</td>
            <td class="" style="width:15%">
                <span> {{ number_format($item->price * $item->qty ).' '.config('price_suffix') }} </span>
            </td>
        </tr>
        <?php $total += $item->qty*$item->price ?>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5" align="right">
            <strong>Total: {{ number_format($total).' '.config('price_suffix') }}</strong>
        </td>
    </tr>
    </tfoot>
</table>

<br>
<br>
<p>You need support now? Just email <a href="mailto:{{ config('admin_email') }}">{{ config('admin_email') }}</a>.</p>
<br>
<br>
<strong>Best regards!</strong>
