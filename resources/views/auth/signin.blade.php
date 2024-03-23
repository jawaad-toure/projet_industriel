@extends('base')

@section('content')

<div class="container">

    <div class="d-flex flex-column align-items-center">

        <h1 class="fw-bold text-center py-4">Ouverture de session</h1>

        <form method="POST" action="{{ route('signin.post') }}" class="col-sm-4">
            @csrf

            @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }} &#9785;
            </div>
            @endif

            <div class="my-2">
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email" aria-describedby="email_feedback" class="py-3 form-control shadow-none @error('email') is-invalid @enderror" />

                @error('email')
                <div id="email_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="my-2 d-flex flex-column">
                <a href="/signin/forgot-password" class="align-self-end link-underline link-underline-opacity-0">Mot de passe oublié ?</a>
                <input type="password" id="password" name="password" placeholder="mot de passe" aria-describedby="password_feedback" class="py-3 form-control shadow-none @error('password') is-invalid @enderror" />

                @error('password')
                <div id="password_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="fw-bold btn btn-primary shadow-none py-3 my-2">Se connecter</button>
            </div>

        </form>

        <div class="col-sm-4 d-flex flex-column align-items-center">
            <span>Vous n'avez pas encore un compte ?</span>
            <a href="/signup" class="link-underline link-underline-opacity-0">C'est par ici pour en créer un !</a>
        </div>

    </div>

</div>

@endsection