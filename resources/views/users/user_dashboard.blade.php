@extends('base')

@section('content')

<div class="container">
    <div class="d-flex flex-column">
        <div class="my-3">
            <div class="border-bottom py-2 mb-3">
                <div class="fw-bold fs-5 align-self-center">
                    Informations personnelles
                </div>
            </div>

            <div class="d-flex mb-3">
                <img src="{{ asset($user['profile_picture']) }}" width="200" height="200" class="rounded mr-3" alt="profile picture">

                <div class="d-flex flex-column ms-4">
                    <div class="my-2">
                        <span class="fw-bold">Pseudonyme : </span>{{ session()->get('user')['username'] }}
                    </div>

                    <div class="my-2">
                        <span class="fw-bold">Nom : </span>{{ session()->get('user')['firstname'] }} {{ session()->get('user')['lastname'] }}
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

            <div class="d-flex gap-2">
                <a 
                    class="btn btn-success me-1" 
                    href="{{ route('user.informations.show', ['userId' => session()->get('user')['id']]) }}" role="button"
                >
                    Modifier
                </a>
                
                <form 
                    method="POST" 
                    action="{{ route('user.informations.delete', ['userId' => session()->get('user')['id']]) }}" class="d-grid"
                >
                    @csrf
                
                    <button type="submit" class="btn btn-outline-danger ms-1" >Supprimer</button>
                </form>
            </div>
        </div>

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
</div>

@endsection