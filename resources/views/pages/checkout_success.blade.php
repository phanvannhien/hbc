@extends('layouts.app')
<?php
$cart = Cart::getContent();
?>
@section('content')
    <div class="main">
        <div class="container">

            <h2> Thanks for your order </h2>
            @if( Auth::check() )
                <p>Review order: <a href="{{ route('user.order.detail', $order->id ) }}">here</a></p>
            @endif

            <h2>Order #{{ $order->id }}</h2>

                <h3>Shipping info</h3>

            <p>Phone: <a href="{{ $order->phone  }}">{{ $order->phone  }}</a></p>
            <p>Address: {{ $order->address  }}</p>
            <p>Status: <span class="label label-info">{{ $order->status }}</span></p>
            <p>Total: <strong class="price">{{ $order->getTotal() }}</strong></p>
            <p>Note: {{ $order->note }}</p>
            <hr>
            <h3>Order detail</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Sub Total</th>
                    <th>Order date</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $order->detail as $item )
                    <tr>
                        <td>
                            <a href="{{ route('product.detail', [ 'id' => $item->product->id, 'slug' => $item->product->slug ]) }}">
                                <img width="100" src="{{ $item->product->product_image }}" alt="{{ $item->product->product_name }}">
                            </a>
                            <a href="{{ route('product.detail', [ 'id' => $item->product->id, 'slug' => $item->product->product_slug ]) }}">
                                {{ $item->product->product_name }}
                            </a>
                        </td>
                        <td>{{ $item->qty }}</td>
                        <td class=""><strong class="price">{{ $item->getSubTotal() }}</strong></td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop