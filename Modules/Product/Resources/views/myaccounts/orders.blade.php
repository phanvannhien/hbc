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

                    <h2>@lang('product::order.your_order')</h2>
                    <p class="pull-right">Total: {{ $orders->total() }} </p>
                    <table class="table table-bordered table-mobile">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>@lang('product::order.total')</th>
                            <th>@lang('product::order.status')</th>
                            <th>@lang('product::order.created_at')</th>
                            <th>@lang('app.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $orders as $order )
                            <tr>
                                <td data-label="ID">{{ $order->id }}</td>
                                <td data-label="Status"><span class="label label-info">{{ $order->status }}</span></td>
                                <td data-label="Total">{{ $order->getTotal() }}</td>
                                <td data-label="Order date">{{ $order->created_at }}</td>
                                <td data-label="Action"><a href="{{ route('user.order.detail', $order->id) }}">
                                        @lang('app.view_more')
                                    </a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="pagination">
                        {!! $orders->render() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop