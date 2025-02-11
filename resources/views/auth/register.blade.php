@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <h1>Register</h1>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            @error('email') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            @error('password') <p style="color: red;">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        <button type="submit">Register</button>
    </form>
    <p>Sudah punya akun? <a href="{{ route('login.form') }}">Login di sini</a>.</p>
@endsection
