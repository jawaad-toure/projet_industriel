@extends('base')

@section('content')

<div class="d-flex flex-column align-items-center mb-5">

    <h1 class="text-center py-4">Adresse email</h1>

    <form method="POST" action="{{ route('email.update', ['userId' => session()->get('user')['id']]) }}" class="d-grid">
        @csrf
        @method('PUT')        

        @if ($errors->any())
        <div class="alert alert-warning">
            Echec de la mise à jour &#9785;
        </div>
        @endif

        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }} &#128578;
        </div>
        @endif


        <div class="d-flex flex-column gap-1 mb-3">
            <div class="align-self-center text-center mb-3">
                <span class="fs-3 fw-bold text-danger">Attention !</span><br />
                Vous devez vérifier votre email pour que la mise à jour soit effective.
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="example@email.com" aria-describedby="email_feedback" class="py-3 form-control shadow-none @error('email') is-invalid @enderror" />

                @error('email')
                <div id="email_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="d-flex justify-content-center gap-2">
            <button type="submit" class="btn btn-success btn-lg shadow-none">Valider</button>
            <a class="btn btn-secondary btn-lg" href="{{ route('dashboard.show', ['userId' => session()->get('user')['id']]) }}" role="button">
                Retour
            </a>
        </div>

    </form>

</div>

@endsection