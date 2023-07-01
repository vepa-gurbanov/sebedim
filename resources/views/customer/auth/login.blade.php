@extends('customer.auth.app')
@section('c-content')
        <form method="POST" action="{{ route('login') }}">
            @csrf
            @honeypot
            {{--<img class="" src="{{ asset('img/logo.png') }}" alt="" width="auto" height="150">--}}

            <div class="input-group">
                <span class="input-group-text">+993</span>
                <input type="text" class="form-control" name="phone_number" placeholder="60000000" min="60000000" max="65999999" autofocus required>
            </div>

            <button class="btn btn-primary w-100 py-2 mt-2" type="submit">Send Code</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
        </form>
@endsection
