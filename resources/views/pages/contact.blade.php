@extends('layouts.app')

@section('content')
    <div class="main">
        <div class="container">

            <div class="row">
                <div class="col-md-3 d-none d-md-block">
                    @include('partials.sidebar')
                </div>
                <div class="col-md-9">
                    @include('partials.messages')
                    <h2>@lang('app.send_contact')</h2>
                    <div class="row">
                        <div class="col-md-6 mb-5">

                            <form id="frm-contact" method="post" action="{{route('page.contact.save')}}" class="">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input name="your_name" type="text" class="form-control" required placeholder="@lang('app.your_name')">
                                </div>
                                <div class="form-group">
                                    <input name="your_email" type="text" class="form-control" required placeholder="@lang('app.your_email')">
                                </div>
                                <div class="form-group">
                                    <input name="your_subject" type="text" class="form-control" required placeholder="@lang('app.your_subject')">
                                </div>
                                <div class="form-group">
                                    <textarea placeholder="@lang('app.message')" name="your_message" class="form-control" id="" cols="30" rows="3"></textarea>
                                </div>
                                <button class="btn btn-primary" type="submit" name="submit">@lang('app.send')</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div id="contact-info">
                                <h3>{{ \App\Helpers\Configuration::getConfig('company_name') }}</h3>

                                <p><i class="fa fa-map-marker"></i> {{ \App\Helpers\Configuration::getConfig('address') }}</p>
                                <p><i class="fa fa-phone"></i> <a href="tel:{{ \App\Helpers\Configuration::getConfig('phone') }}">
                                        {{ \App\Helpers\Configuration::getConfig('phone') }}</a></p>
                                <p><i class="fa fa-envelope"></i> <a href="mailto:{{ \App\Helpers\Configuration::getConfig('email') }}">
                                        {{ \App\Helpers\Configuration::getConfig('email') }}</a> </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
