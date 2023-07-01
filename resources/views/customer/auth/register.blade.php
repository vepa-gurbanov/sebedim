@extends('customer.auth.app')
@section('c-content')
        <form method="POST" action="{{ route('register') }}">
            @csrf
            @honeypot
            {{--<img class="" src="{{ asset('img/logo.png') }}" alt="" width="auto" height="150">--}}

            <div class="mb-3 input-group">
                <span class="input-group-text w-25 fw-bold">Name <span class="text-danger">*</span></span>
                <input type="text" class="form-control" name="name" placeholder="St. Jones" autofocus required>
            </div>
            <div class="mb-3 input-group">
                <span class="input-group-text w-25">+993</span>
                <input type="text" class="form-control" name="phone_number" placeholder="60000000" min="60000000" max="65999999" required>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Register</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
        </form>
@endsection
