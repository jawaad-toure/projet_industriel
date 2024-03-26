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
                    <img src="{{ asset($user['avatar']) }}" class="object-fit-cover img-thumbnail rounded mr-3" width="200" height="200" alt="avatar">

                    <div class="d-flex justify-content-center gap-4">
                        <!-- button upload avatar -->
                        <form method="POST" action="{{ route('avatar.update', ['userId' => session()->get('user')['id']]) }}" enctype="multipart/form-data" class="d-grid">
                            @csrf
                            @method('PUT')

                            <button type="button" class="btn btn-secondary d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#updateAvatarModal">
                                <i class="bi bi-upload"></i>
                            </button>

                            <!-- modal -->
                            <div class="modal fade" id="updateAvatarModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border border-0">
                                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="form-group my-2">
                                                <input type="file" id="avatar" name="avatar" accept="image/*" aria-describedby="avatar_feedback" class="form-control shadow-none @error('avatar_feedback') is-invalid @enderror" />

                                                @error('avatar')
                                                <div id="avatar_feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="modal-footer border border-0">
                                            <button type="button" class="fw-bold btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="fw-bold btn btn-success">Valider</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- button delete avatar -->
                        <form method="POST" action="{{ route('avatar.delete', ['userId' => session()->get('user')['id']]) }}" class="d-grid">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger d-flex justify-content-center align-items-center">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="d-flex flex-column">
                    <div class="my-2">
                        <span class="fw-bold">Pseudonyme : </span>{{ $user['username'] }}
                    </div>

                    <div class="my-2">
                        <span class="fw-bold">Nom : </span>{{ $user['firstname'] }} {{ $user['lastname'] }}
                    </div>

                    <div class="my-2">
                        <span class="fw-bold">Email : </span>{{ $user['email'] }}
                    </div>

                    <div class="my-2">
                        <span class="fw-bold">Date de naissance : </span>{{ $user['birthdate'] }}
                    </div>

                    <div class="my-2">
                        <span class="fw-bold">Adresse : </span>{{ $user['address'] }}
                    </div>

                    <div class="my-2">
                        <span class="fw-bold">Numéro : </span>{{ $user['phone'] }}
                    </div>
                </div>

            </div>

            <div class="d-flex flex-column gap-2">
                <!-- button edit email -->
                <a role="button" class="fw-bold btn btn-secondary" href="{{ route('informations.show', ['userId' => session()->get('user')['id']]) }}">
                    Modifier mes informations
                </a>

                <!-- button edit email -->
                <a type="button" class="fw-bold btn btn-secondary" href="{{ route('email.show', ['userId' => session()->get('user')['id']]) }}">
                    Modifier mon email
                </a>

                <!-- button update password -->
                <a type="button" class="fw-bold btn btn-secondary" href="{{ route('password.show', ['userId' => session()->get('user')['id']]) }}">
                    Modifier mon mot de passe
                </a>

                <!-- button logout -->
                <form method="POST" action="{{ route('logout') }}" class="d-grid">
                    @csrf

                    <button type="submit" class="fw-bold btn btn-outline-danger hover-effect-disabled --danger active-effect-disabled">
                        Déconnexion
                    </button>
                </form>

                <!-- button delete account -->
                <form method="POST" action="{{ route('user.delete', ['userId' => session()->get('user')['id']]) }}" class="d-grid">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="fw-bold btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
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
                                    <button type="button" class="fw-bold btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="fw-bold btn btn-danger">Supprimer</button>
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
        <div class="d-flex justify-content-between border-bottom py-3 mb-3">
            <div class="fw-bold fs-5 align-self-center">
                Recettes
            </div>
            <a class="fw-bold btn btn-outline-primary rounded-pill" href="{{ route('createRecipeForm.show', ['userId' => session()->get('user')['id']]) }}" role="button">Ajouter</a>
        </div>

        <!-- notifications -->
        @if (session('recipe_warning'))
        <div class="alert alert-warning">
            {{ session('recipe_warning') }} &#9785;
        </div>
        @endif

        @if (session('recipe_success'))
        <div class="alert alert-success">
            {{ session('recipe_success') }} &#128578;
        </div>
        @endif

        @if (count($userRecipes) != 0)
        <div class="d-flex flex-column gap-2">
            @foreach ($userRecipes as $userRecipe)
            <div class="d-flex flex-sm-row flex-column justify-content-between border rounded p-2 gap-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center">
                        <form id="visibilityOnForm" method="POST" action="{{ route('recipeSetOnPublic.update', ['userId' => session()->get('user')['id'], 'recipeId' => $userRecipe->id]) }}">
                            @csrf
                            @method('PUT')

                            <button type="submit" class="btn btn-sm btn-secondary border-end-0 rounded-end-0 btn-on @if ($userRecipe->visibility === 1) is-public @endif" @if ($userRecipe->completed === 0) disabled @endif>
                                ON
                            </button>
                        </form>

                        <form id="visibilityOffForm" method="POST" action="{{ route('recipeSetOnPrivate.update', ['userId' => session()->get('user')['id'], 'recipeId' => $userRecipe->id]) }}">
                            @csrf
                            @method('PUT')

                            <button type="submit" class="btn btn-sm btn-secondary border-start-0 rounded-start-0 btn-off @if ($userRecipe->visibility === 0) is-private @endif" @if ($userRecipe->completed === 0) disabled @endif>
                                OFF
                            </button>
                        </form>
                    </div>


                    <div class="d-flex align-items-center fw-medium">
                        {{ $userRecipe->recipename }}
                    </div>
                </div>

                <div class="d-flex justify-content-center align-item-center gap-2">
                    <a type="button" href="{{ route('recipe.show', ['recipeId' => $userRecipe->id]) }}" class="btn btn-secondary d-flex justify-content-center align-items-center @if ($userRecipe->completed === 0) disabled @endif">
                        <i class="bi bi-eye"></i>
                    </a>

                    <a type="button" href="{{ route('updateRecipeForm.show', ['userId' => session()->get('user')['id'], 'recipeId' => $userRecipe->id]) }}" class="btn btn-success d-flex justify-content-center align-items-center">
                        <i class="bi bi-pencil-square"></i>
                    </a>

                    <form method="POST" action="{{ route('recipe.delete', ['userId' => session()->get('user')['id'], 'recipeId' => $userRecipe->id]) }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger d-flex justify-content-center align-items-center">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center">
            Aucune recette partagée
        </div>
        @endif

    </div>

    <!-- Favoris -->
    <div class="my-3">
        <div class="d-flex justify-content-between border-bottom py-3 mb-3">
            <div class="fw-bold fs-5 align-self-center">
                Favoris
            </div>
        </div>

        <!-- notifications -->
        @if (session('favorite_warning'))
        <div class="alert alert-warning">
            {{ session('favorite_warning') }} &#9785;
        </div>
        @endif

        @if (session('favorite_success'))
        <div class="alert alert-success">
            {{ session('favorite_success') }} &#128578;
        </div>
        @endif

        @if (count($userFavoriteRecipes) != 0)
        <div class="d-flex flex-column gap-2">
            @foreach ($userFavoriteRecipes as $favoriteRecipe)
            <div class="d-flex flex-sm-row flex-column justify-content-between border rounded p-2 gap-2">
                <div class="d-flex align-items-center fw-medium">
                    {{ $favoriteRecipe->recipename }}
                </div>

                <div class="d-flex justify-content-center align-item-center gap-2">
                    <a type="button" href="{{ route('recipe.show', ['recipeId' => $favoriteRecipe->id_recipe]) }}" class="btn btn-secondary d-flex justify-content-center align-items-center @if ($userRecipe->completed === 0) disabled @endif">
                        <i class="bi bi-eye"></i>
                    </a>

                    <form method="POST" action="{{ route('favorite.delete', ['userId' => session()->get('user')['id'], 'favoriteId' => $favoriteRecipe->id]) }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger d-flex justify-content-center align-items-center">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center">
            Aucune recette ajoutée en favoris
        </div>
        @endif
    </div>

    <!-- Commentaires -->
    <div class="my-3">
        <div class="d-flex justify-content-between border-bottom py-3 mb-3">
            <div class="fw-bold fs-5 align-self-center">
                Commentaires
            </div>
        </div>

        <!-- notifications -->
        @if (session('star_comment_warning'))
        <div class="alert alert-warning">
            {{ session('star_comment_warning') }} &#9785;
        </div>
        @endif

        @if (session('star_comment_success'))
        <div class="alert alert-success">
            {{ session('star_comment_success') }} &#128578;
        </div>
        @endif

        @if (count($userRecipesCommented) != 0)
        <div class="d-flex flex-column gap-2">
            @foreach ($userRecipesCommented as $userRecipeCommented)
            <div class="d-flex flex-sm-row flex-column justify-content-between border rounded p-2 gap-2">
                <div class="d-flex align-items-center fw-medium">
                    {{ $userRecipeCommented->recipename }}
                </div>

                <div class="d-flex justify-content-center align-item-center gap-2">
                    <a type="button" href="{{ route('recipe.show', ['recipeId' => $userRecipe->id]) }}" class="btn btn-secondary d-flex justify-content-center align-items-center @if ($userRecipe->completed === 0) disabled @endif">
                        <i class="bi bi-eye"></i>
                    </a>

                    <form method="POST" action="{{ route('starComment.delete', ['userId' => session()->get('user')['id'], 'starCommentId' => $userRecipeCommented->id]) }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger d-flex justify-content-center align-items-center">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center">
            Aucune recette commentée
        </div>
        @endif
    </div>
</div>


@endsection