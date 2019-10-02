@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="container">
            @include('partials.messages')
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">@lang('auth.register')</div>

                        <div class="card-body">
                            @include('partials.frm_register')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
