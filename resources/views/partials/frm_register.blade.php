<form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
    @csrf

     <div class="form-group">
        <label for="name" class="">{{ trans('auth.name') }}</label>
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
               name="name" value="{{ old('name') }}" required>
        @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif

    </div>

    <div class="form-group">
        <label for="email" class="">{{ trans('auth.email') }}</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
               name="email" value="{{ old('email') }}" required>
        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif

    </div>

    <div class="form-group">
        <label for="password" class="">{{ trans('auth.password') }}</label>
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group">
        <label for="password-confirm" class=" text-md-right">{{ trans('auth.password_confirm') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

    </div>

    <div class="form-group">

        <button type="submit" class="btn btn-primary">
            {{ trans('auth.register') }}
        </button>

    </div>
</form>