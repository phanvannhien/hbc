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

                    <form method="post" action="{{ route('user.change_password.post') }}">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token">

                        <h3>@lang('product::customer.change_password')</h3>
                        <div class="form-group required">
                            <label for="InputPasswordCurrent">@lang('product::customer.old_password') <sup class="text-red"> * </sup> </label>
                            <input required type="password" value="{{ old('old_pass') }}" name="old_pass" class="form-control" id="InputPasswordCurrent" placeholder="******">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('product::customer.new_password') <span class="text-red">*</span></label>
                            <input required name="password"  value="{{ old('password') }}"  type="password" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('product::customer.password_confirm')<span class="text-red">*</span></label>
                            <input  required value="{{ old('password_confirmation') }}"  name="password_confirmation" type="password" class="form-control" placeholder="">
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp; @lang('app.save')</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop