@extends('admin.auth.app')
@section('content')
    <form method="POST" action="{{ route('admin.auth.verify', ['id' => $id]) }}">
        @csrf
        @honeypot
        @method('POST')

        <div class="input-group">
            <input type="text" class="form-control @error('otp_code') is-invalid @enderror" name="otp_code" placeholder="OTP Code" aria-label="OTP Code" aria-describedby="otp_code">
            <button class="input-group-text btn btn-primary" id="otp_code"><i class="bi-arrow-right-short"></i></button>
        </div>

    </form>
@endsection
