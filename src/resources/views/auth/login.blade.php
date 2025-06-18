@extends('app')

@section('title', 'Logowanie')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <h1 class="mb-4">Logowanie</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required autofocus>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Hasło</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Zapamiętaj mnie</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Zaloguj</button>
        </form>
        <div class="mt-3">
            <a href="{{ route('register') }}">Nie masz konta? Zarejestruj się</a>
        </div>
    </div>
</div>
@endsection