<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
    @csrf

    <div class="form-group">
        <label for="email" class="col-form-label">{{ trans('auth.email') }}</label>

        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
               value="{{ old('email') }}" required autofocus>

        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
        @endif

    </div>

    <div class="form-group">
        <label for="password" class=" col-form-label">{{ trans('auth.password') }}</label>


        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
               name="password" required>

        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
        @endif

    </div>

    <div class="form-group">

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember"
                   id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">{{ trans('auth.remember') }}
            </label>
        </div>

    </div>

    <div class="form-group">

        <button type="submit" class="btn btn-primary">
            {{ trans('auth.login') }}
        </button>

        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ trans('auth.forgot_password') }}
        </a>

    </div>
</form>