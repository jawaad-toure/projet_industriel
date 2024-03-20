@extends('base')

@section('content')

<div class="container mb-5">

    <div class="d-flex flex-column align-items-center mb-4">

        <h1 class="text-center py-4">Informations personnelles</h1>

        <form method="POST" action="{{ route('user.informations.update', ['userId' => session()->get('user')['id']]) }}" enctype="multipart/form-data" class="col-md-7">
            @csrf
            @method('PUT')

            @if ($errors->any())
            <div class="alert alert-warning">
                Echec de la mise à jour &#9785;
            </div>
            @endif

            <div class="row row-cols-md-2 gx-2 mb-3">
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

            <div class="row row-cols-md-2 gx-2 mb-3">
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

            <div class="row row-cols-md-2 gx-2 mb-3">
                <div class="form-group my-2">
                    <label for="email" class="form-label fw-bold">
                        Email
                    </label>

                    <input type="email" id="email" name="email" value="{{session()->get('user')['email']}}" placeholder="email" aria-describedby="email_feedback" class="py-3 form-control shadow-none @error('email') is-invalid @enderror" />

                    @error('email')
                    <div id="email_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

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

            <div class="row row-cols-md-3 gx-2 mb-3">
                <div class="form-group my-2">
                    <label for="password" class="form-label fw-bold">
                        Mot de passe actuel
                    </label>

                    <input type="password" id="password" name="password" placeholder="mot de passe" aria-describedby="password_feedback" class="py-3 form-control shadow-none @error('password') is-invalid @enderror" />

                    @error('password')
                    <div id="password_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="new_password" class="form-label fw-bold">
                        Nouveau mot de passe
                    </label>

                    <input type="password" id="new_password" name="new_password" placeholder="nouveau mot de passe" aria-describedby="new_password_feedback" class="py-3 form-control shadow-none @error('new_password') is-invalid @enderror" />

                    @error('new_password')
                    <div id="new_password_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="password_confirmed" class="form-label fw-bold">
                        Confirmer mot de passe
                    </label>

                    <input type="password" id="password_confirmed" name="password_confirmed" placeholder="confirmer nouveau mot de passe" aria-describedby="password_confirmed_feedback" class="py-3 form-control shadow-none @error('password_confirmed') is-invalid @enderror" />

                    @error('password_confirmed')
                    <div id="password_confirmed_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group my-2 mb-3">
                <label for="profile_picture" class="form-label fw-bold">
                    Photo de profil
                </label>

                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" aria-describedby="profile_picture_feedback" class="py-3 form-control shadow-none @error('profile_picture_feedback') is-invalid @enderror" />

                @error('profile_picture')
                <div id="profile_picture_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="flex-fill btn btn-success btn-lg shadow-none">Mettre à jour</button>
                <a class="flex-fill btn btn-secondary btn-lg" href="{{ route('user.dashboard.show', ['userId' => session()->get('user')['id']]) }}" role="button">
                    Retour
                </a>
            </div>

        </form>

    </div>


    <div class="d-flex flex-column align-items-center mb-4">

        <h1 class="text-center py-4">Email</h1>

        <form method="POST" action="{{ route('user.informations.update', ['userId' => session()->get('user')['id']]) }}" enctype="multipart/form-data" class="col-md-7">
            @csrf
            @method('PUT')

            @if ($errors->any())
            <div class="alert alert-warning">
                Echec de la mise à jour &#9785;
            </div>
            @endif

            <div class="mb-3">
                <div class="form-group my-2">
                    <label for="email" class="form-label fw-bold">
                        Email
                    </label>

                    <input type="email" id="email" name="email" value="{{session()->get('user')['email']}}" placeholder="email" aria-describedby="email_feedback" class="py-3 form-control shadow-none @error('email') is-invalid @enderror" />

                    @error('email')
                    <div id="email_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="flex-fill btn btn-success btn-lg shadow-none">Mettre à jour</button>
                <a class="flex-fill btn btn-secondary btn-lg" href="{{ route('user.dashboard.show', ['userId' => session()->get('user')['id']]) }}" role="button">
                    Retour
                </a>
            </div>

        </form>

    </div>


    <div class="d-flex flex-column align-items-center mb-4">

        <h1 class="text-center py-4">Mot de passe</h1>

        <form method="POST" action="{{ route('user.informations.update', ['userId' => session()->get('user')['id']]) }}" enctype="multipart/form-data" class="col-md-7">
            @csrf
            @method('PUT')

            @if ($errors->any())
            <div class="alert alert-warning">
                Echec de la mise à jour &#9785;
            </div>
            @endif

            <div class="row row-cols-md-3 gx-2 mb-3">
                <div class="form-group my-2">
                    <label for="password" class="form-label fw-bold">
                        Mot de passe actuel
                    </label>

                    <input type="password" id="password" name="password" placeholder="mot de passe" aria-describedby="password_feedback" class="py-3 form-control shadow-none @error('password') is-invalid @enderror" />

                    @error('password')
                    <div id="password_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="new_password" class="form-label fw-bold">
                        Nouveau mot de passe
                    </label>

                    <input type="password" id="new_password" name="new_password" placeholder="nouveau mot de passe" aria-describedby="new_password_feedback" class="py-3 form-control shadow-none @error('new_password') is-invalid @enderror" />

                    @error('new_password')
                    <div id="new_password_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="password_confirmed" class="form-label fw-bold">
                        Confirmer mot de passe
                    </label>

                    <input type="password" id="password_confirmed" name="password_confirmed" placeholder="confirmer nouveau mot de passe" aria-describedby="password_confirmed_feedback" class="py-3 form-control shadow-none @error('password_confirmed') is-invalid @enderror" />

                    @error('password_confirmed')
                    <div id="password_confirmed_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="flex-fill btn btn-success btn-lg shadow-none">Mettre à jour</button>
                <a class="flex-fill btn btn-secondary btn-lg" href="{{ route('user.dashboard.show', ['userId' => session()->get('user')['id']]) }}" role="button">
                    Retour
                </a>
            </div>

        </form>

    </div>


    <div class="d-flex flex-column align-items-center mb-4">

        <h1 class="text-center py-4">Avatar</h1>

        <form method="POST" action="{{ route('user.informations.update', ['userId' => session()->get('user')['id']]) }}" enctype="multipart/form-data" class="col-md-7">
            @csrf
            @method('PUT')

            @if ($errors->any())
            <div class="alert alert-warning">
                Echec de la mise à jour &#9785;
            </div>
            @endif

            <div class="mb-3">
                <div class="form-group my-2">
                    <label for="profile_picture" class="form-label fw-bold">
                        Photo de profil
                    </label>

                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*" aria-describedby="profile_picture_feedback" class="py-3 form-control shadow-none @error('profile_picture_feedback') is-invalid @enderror" />

                    @error('profile_picture')
                    <div id="profile_picture_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="flex-fill btn btn-success btn-lg shadow-none">Mettre à jour</button>
                <a class="flex-fill btn btn-secondary btn-lg" href="{{ route('user.dashboard.show', ['userId' => session()->get('user')['id']]) }}" role="button">
                    Retour
                </a>
            </div>

        </form>

    </div>

</div>

@endsection






