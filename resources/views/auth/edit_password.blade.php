@extends('base')

@section('content')

<div class="container">

    <div class="d-flex flex-column align-items-center">

        <h1 class="text-center py-4">Nouveau de mot de passe</h1>

        <form method="POST" action="{{ route('editPassword.post', ['userId' => $userId]) }}" class="col-sm-4">
            @csrf

            @if ($errors->any())
            <div class="alert alert-warning">
                Echec de la modification &#9785;
            </div>
            @endif

            @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }} &#128578;
            </div>
            @endif

            <div class="form-group my-2 d-flex flex-column">
                <input type="password" id="password" name="password" placeholder="mot de passe" aria-describedby="password_feedback" class="py-3 form-control shadow-none @error('password') is-invalid @enderror" />

                @error('password')
                <div id="password_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group my-2">
                <input type="password" id="password_confirmed" name="password_confirmed" placeholder="confirmer mot de passe" aria-describedby="password_confirmed_feedback" class="py-3 form-control shadow-none @error('password_confirmed') is-invalid @enderror" />

                @error('password_confirmed')
                <div id="password_confirmed_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success btn-lg shadow-none my-2">Valider</button>
            </div>
        </form>

    </div>

</div>

@endsection