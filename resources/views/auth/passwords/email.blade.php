@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">@lang('auth.reset_password')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <div class="form-group ">
                            <label for="email" class=" col-form-label">@lang('auth.email')</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group">

                            <button type="submit" class="btn btn-primary">
                                @lang('app.send')
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </main>
@endsection
