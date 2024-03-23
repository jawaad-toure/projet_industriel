@extends('base')

@section('content')

<div class="container">

    <div class="d-flex flex-column align-items-center mb-5">

        <h1 class="fw-bold text-center py-4">Mot de passe</h1>

        <form method="POST" action="{{ route('password.update', ['userId' => session()->get('user')['id']]) }}" class="col-sm-4">
            @csrf
            @method('PUT')            

            @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }} &#9785;
            </div>
            @endif

            <div class="d-flex flex-column gap-1 mb-3">
                <div class="text-center mb-3">
                    <span class="fs-3 fw-bold text-warning">&#9888; Note</span><br />
                    Vous serez déconnecté.e après modification du mot de passe.
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="mot de passe" aria-describedby="password_feedback" class="py-3 form-control shadow-none @error('password') is-invalid @enderror" />

                    @error('password')
                    <div id="password_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" name="new_password" placeholder="nouveau mot de passe" aria-describedby="new_password_feedback" class="py-3 form-control shadow-none @error('new_password') is-invalid @enderror" />

                    @error('new_password')
                    <div id="new_password_feedback" class="invalid-feedback d-flex">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" name="new_password_confirmed" placeholder="confirmer nouveau mot de passe" aria-describedby="new_password_confirmed_feedback" class="py-3 form-control shadow-none @error('new_password_confirmed') is-invalid @enderror" />

                    @error('new_password_confirmed')
                    <div id="new_password_confirmed_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-center gap-2">
                <button type="submit" class="fw-bold btn btn-success">Valider</button>
                <a class="fw-bold btn btn-secondary" href="{{ route('dashboard.show', ['userId' => session()->get('user')['id']]) }}" role="button">
                    Retour
                </a>
            </div>

        </form>

    </div>

</div>

@endsection