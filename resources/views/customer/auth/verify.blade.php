@extends('customer.auth.app')
@section('c-content')
    <form method="POST" action="{{ route('login', ['token' => $token]) }}" id="resendCode">
        @csrf
        @honeypot
        <div class="input-group mb-3">
            <span class="input-group-text">+993</span>
            <input type="text" class="form-control" name="phone_number" placeholder="60000000" value="{{ $phone }}" disabled>
        </div>
    </form>

    <form method="POST" action="{{ route('verify', ['token' => $token]) }}">
        @csrf
        @honeypot

        <div class="input-group mb-3">
            <input type="text" class="form-control" name="code" autofocus>
            <button class="input-group-text btn btn-primary" type="button"
                    onclick="event.preventDefault(); $('input[name=phone_number]').removeAttr('disabled'); $('form#resendCode').submit();">
                <i class="bi-arrow-clockwise"></i>
            </button>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Confirm</button>
        <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
    </form>
@endsection
