@extends('base')

@section('content')


<div class="d-flex flex-column">

    <!-- Informations personnelles -->
    <div class="my-3">
        <div class="border-bottom py-2 mb-3">
            <div class="fw-bold fs-5 align-self-center">
                Informations personnelles
            </div>
        </div>

        <div class="d-flex flex-column flex-md-row gap-5 mb-3">
            <div class="d-flex flex-column flex-sm-row gap-4">
                <div class="d-flex row-gap-2 flex-column align-items-center">
                    <img src="{{ asset($user['avatar']) }}" class="object-fit-cover img-thumbnail rounded mr-3" style="width: 200px; height: 200px" alt="avatar">

                    <div class="d-flex justify-content-center gap-4">
                        <!-- button edit avatar -->
                        <form method="POST" action="{{ route('avatar.update', ['userId' => session()->get('user')['id']]) }}" enctype="multipart/form-data" class="d-grid">
                            @csrf
                            @method('PUT')

                            <button type="button" class="btn btn-secondary d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#updateAvatarModal">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <div class="modal fade" id="updateAvatarModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content">
                                        <div class="modal-header border border-0">
                                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="form-group my-2">
                                                <input type="file" id="avatar" name="avatar" accept="image/*" aria-describedby="avatar_feedback" class="py-3 form-control shadow-none @error('avatar_feedback') is-invalid @enderror" />

                                                @error('avatar')
                                                <div id="avatar_feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="modal-footer border border-0">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-success">Valider</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>

                        <!-- button delete avatar -->
                        <form method="POST" action="{{ route('avatar.delete', ['userId' => session()->get('user')['id']]) }}" class="d-grid">
                            @csrf

                            <button type="submit" class="btn btn-danger d-flex justify-content-center align-items-center">
                                <i class="bi bi-trash"></i>
                            </button>

                        </form>
                    </div>
                </div>

                <div class="d-flex flex-column">
                    <div class="my-2">
                        <span class="fw-bold">Pseudonyme : </span>{{ session()->get('user')['username'] }}
                    </div>

                    <div class="my-2">
                        <span class="fw-bold">Nom : </span>{{ session()->get('user')['firstname'] }} {{ session()->get('user')['lastname'] }}
                    </div>

                    <div class="my-2">
                        <span class="fw-bold">Email : </span>{{ session()->get('user')['email'] }}
                    </div>

                    <div class="my-2">
                        <span class="fw-bold">Date de naissance : </span>{{ session()->get('user')['birthdate'] }}
                    </div>

                    <div class="my-2">
                        <span class="fw-bold">Adresse : </span>{{ session()->get('user')['address'] }}
                    </div>

                    <div class="my-2">
                        <span class="fw-bold">Numéro : </span>{{ session()->get('user')['phone'] }}
                    </div>
                </div>

            </div>

            <div class="d-flex flex-column gap-2">
                <a role="button" class="btn btn-secondary" href="{{ route('informations.show', ['userId' => session()->get('user')['id']]) }}">
                    Modifier mes informations
                </a>

                <!-- button edit email -->
                <form method="POST" id="updateEmailForm" action="{{ route('email.update', ['userId' => session()->get('user')['id']]) }}" class="d-grid">
                    @csrf
                    @method('PUT')

                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#updateEmailModal">
                        Modifier mon email
                    </button>

                    <div class="modal fade" id="updateEmailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">
                                <div class="modal-header border border-0">
                                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div>
                                        <span class="fs-3 fw-bold text-danger">Attention !</span><br />
                                        Vous devez vérifier votre email pour que la mise à jour soit effective.
                                    </div>

                                    <div class="form-group my-2">
                                        <input type="email" name="email" placeholder="example@email.com" aria-describedby="email_feedback" class="py-3 form-control shadow-none @error('email') is-invalid @enderror" />

                                        @error('email')
                                        <div id="email_feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal-footer border border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-success" id="btnUpdateEmail">Valider</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

                <!-- button update password -->
                <form method="POST" action="{{ route('password.update', ['userId' => session()->get('user')['id']]) }}" class="d-grid">
                    @csrf
                    @method('PUT')

                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#updatePasswordModal">
                        Modifier mon mot de passe
                    </button>

                    <div class="modal fade" id="updatePasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">
                                <div class="modal-header border border-0">
                                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div>
                                        <span class="fs-3 fw-bold text-danger">Attention !</span><br />
                                        Vous serez déconnecté.e après modification du mot de passe.
                                    </div>

                                    <div class="form-group my-2">
                                        <input type="password" name="password" placeholder="mot de passe" aria-describedby="password_feedback" class="py-3 form-control shadow-none @error('password') is-invalid @enderror" />

                                        @error('password')
                                        <div id="password_feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <input type="password" name="new_password" placeholder="nouveau mot de passe" aria-describedby="new_password_feedback" class="py-3 form-control shadow-none @error('new_password') is-invalid @enderror" />

                                        @error('new_password')
                                        <div id="new_password_feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <input type="password" name="new_password_confirmed" placeholder="confirmer nouveau mot de passe" aria-describedby="new_password_confirmed_feedback" class="py-3 form-control shadow-none @error('new_password_confirmed') is-invalid @enderror" />

                                        @error('new_password_confirmed')
                                        <div id="new_password_confirmed_feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal-footer border border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-success">Valider</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

                <!-- button logout -->
                <form method="POST" action="{{ route('logout') }}" class="d-grid">
                    @csrf

                    <button type="submit" class="btn btn-outline-danger hover-effect-disabled">
                        Déconnexion
                    </button>
                </form>

                <!-- button delete account -->
                <form method="POST" action="{{ route('user.delete', ['userId' => session()->get('user')['id']]) }}" class="d-grid">
                    @csrf

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        Supprimer mon compte
                    </button>

                    <div class="modal fade" id="deleteAccountModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">
                                <div class="modal-header border border-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <span class="fs-3 fw-bold text-danger">Attention !</span><br />
                                    Vous êtes sur le point de supprimer votre compte. Cliquez sur 'Supprimer' pour confirmer la suppression.
                                </div>

                                <div class="modal-footer border border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Recettes -->
    <div class="my-3">
        <div class="d-flex justify-content-between border-bottom py-2 mb-3">
            <div class="fw-bold fs-5 align-self-center">
                Recettes
            </div>
            <a class="fw-bold btn btn-outline-primary rounded-pill" href="#" role="button">Ajouter</a>
        </div>

        <div class="text-center">
            Aucune recette ajoutée
        </div>
    </div>

    <!-- Favoris -->
    <div class="my-3">
        <div class="d-flex justify-content-between border-bottom py-2 mb-3">
            <div class="fw-bold fs-5 align-self-center">
                Favoris
            </div>
            <a class="fw-bold btn btn-outline-primary rounded-pill" href="#" role="button">Ajouter</a>
        </div>

        <div class="text-center">
            Aucun favori ajouté
        </div>
    </div>

    <!-- Commentaires -->
    <div class="my-3">
        <div class="d-flex justify-content-between border-bottom py-2 mb-3">
            <div class="fw-bold fs-5 align-self-center">
                Commentaires
            </div>
            <a class="fw-bold btn btn-outline-primary rounded-pill" href="#" role="button">Ajouter</a>
        </div>

        <div class="text-center">
            Aucun commentaire ajouté
        </div>
    </div>
</div>


@endsection