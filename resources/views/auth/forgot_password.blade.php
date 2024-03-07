@extends('base')

@section('content')

<div class="container">

    <div class="d-flex flex-column align-items-center">

        <h1 class="text-center py-4">Authentification</h1>

        <form method="POST" action="{{ route('forgotPassword.post') }}" class="col-sm-4">
            @csrf

            @if ($errors->any())
            <div class="alert alert-warning">
                Echec d'authentification &#9785;
            </div>
            @endif

            @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }} &#128578;
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

            <div class="d-grid">
                <button type="submit" class="btn btn-success btn-lg shadow-none my-2">Envoyer</button>
            </div>
        </form>

    </div>

</div>

@endsection