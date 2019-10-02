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

                    <form method="post" action="{{ route('user.profile.post') }}">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token">
                        <h3>@lang('product::customer.my_info')</h3>
                        <hr>
                        <div class="form-group required">
                            <label for="InputName">@lang('product::customer.full_name')<sup class="text-red">*</sup> </label>
                            <input type="text" class="form-control" id="" placeholder="" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('product::customer.email') <span class="text-red">*</span></label>
                            <input name="phone" value="{{ $user->email }}" readonly disabled type="tel" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('product::customer.phone') <span class="text-red">*</span></label>
                            <input name="phone" value="{{ $user->phone }}" type="tel" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('product::customer.company_name') </label>
                            <input name="company_name" value="{{ $user->company_name }}" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('product::customer.company_address') </label>
                            <input name="company_address" value="{{ $user->company_address }}" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('product::customer.gender')<span class="text-red">*</span></label>
                            <select class="form-control" name="gender" id="">
                                <option {{ ($user->gender == 'male')? 'selected' :''  }} value="male">@lang('product::customer.male')</option>
                                <option {{ ($user->gender == 'female')? 'selected' :''  }} value="female">@lang('product::customer.female')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">@lang('product::customer.date_of_birth')<span class="text-red">*</span></label>
                            <div class="d-flex align-items-center">
                                <?php $dob = explode('-', $user->dob ) ?>
                                <select style="width: 88px" class="dob day form-control" name="day" id="">
                                    <option value="">@lang('product::customer.day')</option>
                                    @for( $i = 1; $i <= 31 ; $i++ )
                                        <option {{ ($dob[0] == $i ) ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <select style="width: 88px" class="dob month form-control" name="month" id="">
                                    <option value="">@lang('product::customer.month')</option>
                                    @for( $i = 1; $i <= 12 ; $i++ )
                                        <option {{ ($dob[1] == $i ) ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <select style="width: 88px" class="dob year form-control" name="year" id="">
                                    <option value="">@lang('product::customer.year')</option>
                                    @for( $i = 1900 ; $i <= 2000 ; $i++ )
                                        <option {{ ($dob[2] == $i ) ? 'selected' : '' }}  value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>



                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp; @lang('app.save')</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop