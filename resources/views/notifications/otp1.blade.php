@extends('notifications.otp')
@section('content')
    <div class="input-group">
        <input type="text" class="form-control" placeholder="OTP Code: " aria-describedby="otp">
        <span class="input-group-text bg-primary" id="otp">{{ $user->otp_code }}</span>
    </div>
@endsection
