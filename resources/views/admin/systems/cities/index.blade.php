@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ trans('city.city') }}</h1>
</section>

<!-- Main content -->
<section class="content">

    <form action="" class="form-inline">
        <div class="form-group">
            <input type="text" name="code" value="{{ Request::get('code') }}" class="form-control">
        </div>
        <button type="submit" value="filter" name="filter" class="btn btn-primary"><i class="fa fa-search"></i> {{ trans('app.filter') }}</button>
    </form>
    <hr>


    <!-- Default box -->
    <div class="box">

        <div class="box-body">
            <table class="table">
                <thead>
                <tr>
                    <td>{{ trans('city.city_name') }}</td>
                    <td>{{ trans('city.city_code') }}</td>
                    <td>{{ trans('city.published') }}</td>
                    <td>{{ trans('city.country_code') }}</td>
                    <td>{{ trans('app.default') }}</td>

                </tr>
                </thead>
                <tbody>
                @foreach( $data as $item )
                <tr>
                    <td>
                        {!! $item->city_name !!}
                    </td>
                    <td>
                        {{ $item->city_code }}
                    </td>
                    <td>
                        {{ $item->published }}
                    </td>
                    <td>
                        {{ $item->country_code }}
                    </td>
                    <td>
                        {{ $item->is_default }}
                    </td>


                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="box-footer text-center">
            <div class="clearfix">
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