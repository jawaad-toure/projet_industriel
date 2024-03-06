@extends('base')

@section('content')



<div class="d-flex flex-column align-items-center mb-5">

    <h1 class="text-center py-4">Informations personnelles</h1>

    <form method="POST" action="{{ route('user.informations.update', ['userId' => session()->get('user')['id']]) }}" class="col-md-7">
        @csrf
        @method('PUT')

        @if ($errors->any())
        <div class="alert alert-warning">
            Echec de la mise à jour &#9785;
        </div>
        @endif

        <!-- firstname and lastname fields -->
        <div class="row row-cols-md-2 gx-2 mb-3">

            <!-- firstname -->
            <div class="form-group my-2">
                <label for="firstname" class="form-label fw-bold">
                    Prénom
                </label>

                <input type="text" id="firstname" name="firstname" value="{{session()->get('user')['firstname']}}" placeholder="prénom" aria-describedby="firstname_feedback" class="py-3 form-control shadow-none @error('firstname') is-invalid @enderror" />

                @error('firstname')
                <div id="firstname_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- lastname -->
            <div class="form-group my-2">
                <label for="lastname" class="form-label fw-bold">
                    Nom
                </label>

                <input type="text" id="lastname" name="lastname" value="{{session()->get('user')['lastname']}}" placeholder="nom de famille" aria-describedby="lastname_feedback" class="py-3 form-control shadow-none @error('lastname') is-invalid @enderror" />

                @error('lastname')
                <div id="lastname_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <!-- birthdate and username fields -->
        <div class="row row-cols-md-2 gx-2 mb-3">

            <!-- birthdate -->
            <div class="form-group my-2">
                <label for="birthdate" class="form-label fw-bold">
                    Date de naissance
                </label>

                <input type="date" id="birthdate" name="birthdate" value="{{session()->get('user')['birthdate']}}" aria-describedby="birthdate_feedback" class="py-3 form-control shadow-none @error('birthdate') is-invalid @enderror" />

                @error('birthdate')
                <div id="birthdate_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- username -->
            <div class="form-group my-2">
                <label for="username" class="form-label fw-bold">
                    Pseudonyme
                </label>

                <input type="text" id="username" name="username" value="{{session()->get('user')['username']}}" placeholder="pseudonyme" aria-describedby="username_feedback" class="py-3 form-control shadow-none @error('username') is-invalid @enderror" />

                @error('username')
                <div id="username_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <!-- address and phone fields -->
        <div class="row row-cols-md-2 gx-2 mb-3">

            <!-- address -->
            <div class="form-group my-2 mb-3">
                <label for="address" class="form-label fw-bold">
                    Adresse
                </label>

                <input type="text" id="address" name="address" value="{{session()->get('user')['address']}}" placeholder="00 rue Nom de la rue" aria-describedby="address_feedback" class="py-3 form-control shadow-none @error('address') is-invalid @enderror" />

                @error('address')
                <div id="address_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- phone -->
            <div class="form-group my-2">
                <label for="phone" class="form-label fw-bold">
                    Téléphone
                </label>

                <input type="tel" id="phone" name="phone" value="{{session()->get('user')['phone']}}" placeholder="+33 07 00 00 00 00" aria-describedby="phone_feedback" class="py-3 form-control shadow-none @error('phone') is-invalid @enderror" />

                @error('phone')
                <div id="phone_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <!-- buttons update and back -->
        <div class="d-flex justify-content-center gap-2">
            <button type="submit" class="btn btn-success btn-lg shadow-none">Valider</button>
            <a class="btn btn-secondary btn-lg" href="{{ route('user.dashboard.show', ['userId' => session()->get('user')['id']]) }}" role="button">
                Retour
            </a>
        </div>

    </form>

</div>



@endsection