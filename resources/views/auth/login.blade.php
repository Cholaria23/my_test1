@extends('frontend.layouts.app')

@section('content')
    <div class="page page--topForHeader pageLogin">
        <div class="container">

            <hr class="fullLine">

            <div class="pageLogin__form">
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="formLabel">E-Mail Address</label>

                        <input id="email" type="email" class="inputText" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="formLabel">Password</label>

                        <input id="password" type="password" class="inputText" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="">
                        <button type="submit" class="eBtn--black">
                            Login
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
