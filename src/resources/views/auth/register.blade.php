@extends('app')

@section('title', 'Rejestracja')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <h1 class="mb-4">Rejestracja</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Imię</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" required autofocus>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Hasło</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Potwierdź hasło</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Zarejestruj się</button>
        </form>
        <div class="mt-3">
            <a href="{{ route('login') }}">Masz już konto? Zaloguj się</a>
        </div>
    </div>
</div>
@endsection