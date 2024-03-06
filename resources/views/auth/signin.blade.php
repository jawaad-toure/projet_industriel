@extends('base')

@section('content')

<div class="container">

    <div class="d-flex flex-column align-items-center">

        <h1 class="text-center py-4">Ouverture de session</h1>

        <form method="POST" action="{{ route('signin.post') }}" class="col-sm-4">
            @csrf

            @if ($errors->any())
            <div class="alert alert-warning">
                Vous n'avez pas pu être authentifié &#9785;
            </div>
            @endif

            <div class="form-group my-2">
                <input type="email" id="email" name="email" placeholder="email" aria-describedby="email_feedback" class="py-3 form-control shadow-none @error('email') is-invalid @enderror" />

                @error('email')
                <div id="email_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group my-2 d-flex flex-column">
                <input type="password" id="password" name="password" placeholder="mot de passe" aria-describedby="password_feedback" class="py-3 form-control shadow-none @error('password') is-invalid @enderror" />
                <a href="" class="align-self-end link-underline link-underline-opacity-0">Mot de passe oublié ?</a>
                @error('password')
                <div id="password_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg shadow-none my-2">Se connecter</button>
            </div>

        </form>

        <div class="col-sm-4 d-flex flex-column align-items-center">
            <span>Vous n'avez pas encore un compte ?</span>
            <a href="/signup" class="link-underline link-underline-opacity-0">C'est par ici pour en créer un !</a>
        </div>

    </div>

</div>

@endsection