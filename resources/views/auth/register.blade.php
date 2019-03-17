@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header reghed">{{ __('Register') }}</div>

                <div class="card-body regbod">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="alert alert-danger" role="alert">
                            EMAIL such as HOTMAIL,AOL and YAHOO do NOT accept our mailserver.  You will NOT be able to verify registration with this email.  We recommend using your ISP or GMAIL.
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('PSN Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tribenamepvp" class="col-xs-3 col-form-label text-md-right">{{ __('PVP Tribe Name') }}</label>

                            <div class="col-xs-3">
                                <input id="tribenamepvp" type="text" class="form-control{{ $errors->has('tribenamepvp') ? ' is-invalid' : '' }}" placeholder="Place None if none" name="tribenamepvp" value="{{ old('tribenamepvp') }}" autofocus required>
                            </div> <div class="form-group row"></div>
                            <label for="tribenamepve" class="col-xs-3 col-form-label text-md-right">{{ __('PVE Tribe Name') }}</label>

                            <div class="col-sx-3">
                                <input id="tribenamepve" type="text" class="form-control{{ $errors->has('tribenamepve') ? ' is-invalid' : '' }}" name="tribenamepve" value="{{ old('tribenamepve') }}" autofocus required placeholder="Place None if none">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-xs-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-xs-3">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="email-confirm" class="col-xs-3 col-form-label text-md-right">{{ __('Retype E-Mail Address') }}</label>

                            <div class="col-xs-3">
                                <input id="email-confirm" type="email" class="form-control{{ $errors->has('email-confirm') ? ' is-invalid' : '' }}" name="email-confirm" value="{{ old('email-confirm') }}" required>

                                @if ($errors->has('email-confirm'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email-confirm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-xs-3 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-xs-3">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="password-confirm" class="col-xs-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-xs-3">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-xs-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
