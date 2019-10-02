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

                    <form class="form" action="{{ route('user.address_book_detail.save', $address->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <lalel>@lang('product::order.full_name') <span class="require">*</span></lalel>
                            <input type="text" name="full_name" class="form-control" value="{{ $address->full_name }}">
                        </div>
                        <div class="form-group">
                            <lalel>@lang('product::order.phone') <span class="require">*</span></lalel>
                            <input type="text" name="phone" class="form-control" value="{{ $address->phone }}">
                        </div>
                        <div class="form-group">
                            <lalel>@lang('product::order.address') <span class="require">*</span></lalel>
                            <input type="text" name="address" class="form-control" value="{{ $address->address }}">
                        </div>

                        <button type="submit" class="btn btn-success" name="submit"><i class="fa fa-save"></i> @lang('app.save')</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@stop