@extends('admin.auth.app')
@section('content')
    <form method="POST" action="{{ route('admin.auth.login') }}">
        @csrf
        @honeypot
        @method('POST')

        <div class="input-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email"  value="{{ old('email') }}" aria-label="Email" aria-describedby="email">
            <button class="input-group-text btn btn-primary" id="email"><i class="bi-arrow-right-short"></i></button>
        </div>
    </form>

@endsection
