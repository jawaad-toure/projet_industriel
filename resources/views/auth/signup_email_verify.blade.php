@extends('base')

@section('content')

<div class="d-flex flex-column gap-3 justify-content-center">
    <div class="fs-1 fw-bold">Validation d'email</div>

    <div>
        Votre demande de création de compte a été bien prise en compte.
    </div>

    <div>
        Il ne vous reste plus qu'à vérifier votre email pour pouvoir vous connecter.
    </div>

    <div>
        Si vous n'avez pas reçu le mail de validation, cliquez sur le button ci-dessous pour le recevoir à nouveau.
    </div>

    <form method="POST" action="{{ route('signup.verify.send', ['userId' => $userId]) }}">
        @csrf
        <button type="submit" class="btn btn-primary">
            Renvoyer le mail
        </button>
    </form>

    <div>
        L'équipe <span class="fw-bold">The Cook Talk</span> !
    </div>
</div>

@endsection