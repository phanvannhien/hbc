@extends('admin.layouts.app')
<?php

$status = [
    'waiting' => 'Waiting',
    'paid' => 'Paid',
    'shipping' => 'Shipping',
    'completed' => 'Completed',
    'refund' => 'Refund',
    'cancel' => 'Cancel',
    'fail' => 'Fail'
];
?>
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('product::order.order') </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <p class="clearfix">
            <a href="{{ route('customer.create') }}" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i> @lang('app.create')</a>
        </p>
        <form action="" class="form-inline">
            <div class="form-group">

                <input type="text" name="id" value="{{ Request::get('id') }}" class="form-control" placeholder="@lang('product::order.id')">
            </div>
            <div class="form-group">
                <input type="text" name="email" value="{{ Request::get('email') }}" class="form-control" placeholder="{{ trans('product::order.email') }}">
            </div>
            <div class="form-group">
                <select name="status" id="" class="form-control">
                    @foreach( $status as $key => $val )
                    <option {{ (Request::get('status') == $key) ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">

                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input name="created_at" value="{{ date('m/d/Y') }} - {{ date('m/d/Y') }}"  type="text" class="form-control pull-right" id="order-date">
                </div>
                <!-- /.input group -->
            </div>
            <button type="submit" value="filter" name="filter" class="btn btn-primary"><i class="fa fa-search"></i> {{ trans('app.filter') }}</button>
        </form>
        <p> </p>

        <!-- Default box -->
        <div class="box">
            <div class="box-header">

            </div>
            <div class="box-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>{{ trans('product::order.id') }}</td>
                        <td>{{ trans('product::order.email') }}</td>
                        <td>{{ trans('product::order.phone') }}</td>
                        <td>{{ trans('product::order.status') }}</td>
                        <td>{{ trans('product::order.total') }}</td>
                        <td>{{ trans('product::order.created_at') }}</td>
                        <td>{{ trans('app.actions') }}</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0; ?>
                    @foreach( $data as $item )

                        <tr>
                            <td><a href="#">#{{ $item->id }}</a></td>
                            <td><a href="mailto:{{ $item->email }}">{{ $item->email }}</a></td>
                            <td><a href="tel:{{ $item->phone }}">{{ $item->phone }}</a></td>
                            <td><span class="label label-info">{{ $item->status }}</span></td>
                            <td>{{ $item->getTotal() }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('order.edit', $item->id ) }}" class="btn btn-sm btn-info"><i class="fa fa-search"></i> {{ trans('app.edit') }}</a>
                                    <a href="{{ route('order.destroy', $item->id ) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> {{ trans('app.delete') }}</a>
                                </div>
                            </td>
                        </tr>
                        <?php $total += $item->getTotalNumber() ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer text-center">
                <div class="clearfix">
                    <p class="pull-left">Total: {{ number_format($total).' '.config('app.price_suffix') }}</p>
                    @if( $data && count($data))
                        <p class="text-right">@lang('app.showing') {{$data->firstItem()}}-{{$data->lastItem()}} @lang('app.of') {{$data->total()}}
                            @lang('app.results')</p>
                    @endif
                </div>

            </div>

        </div>
        <!-- /.box -->
        <div class="text-center">
            {!! $data->appends(request()->input())->links() !!}
        </div>
    </section>
    <!-- /.content -->

@stop

@section('footer')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()


            //Date range picker
            $('#order-date').daterangepicker({

                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            })
        });
    </script>
@stop