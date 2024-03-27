@extends('base')

@section('content')

<div class="d-flex flex-column gap-5">
    <!-- hero -->
    <div class="row d-flex justify-content-center align-items-center mt-3">
        <div class="col-6">
            <img src="{{ asset('uploads/home/hero.png') }}" width="800" height="800" class="object-fit-cover img-fluid" alt="Patissier" />
        </div>

        <div class="col-4 d-flex flex-column justify-content-center gap-5">
            <div class="fw-bold fs-2">
                Partagez votre passion avec le monde
            </div>

            <div class="fs-5">
                The Cook Talk vous aide à partager vos pépites avec
                des milliers de passionnés de cuisines
            </div>


            @if (session()->has('user'))
            <a type="button" href="{{ route('createRecipeForm.show', ['userId' => session()->get('user')['id']]) }}" class="btn btn-primary btn rounded-5 align-self-start fw-bold py-2 px-4">
                Partagez une recette
            </a>
            @else
            <a href="/signin" class="btn btn-primary btn rounded-5 align-self-start fw-bold py-2 px-4">
                Partagez une recette
            </a>
            @endif
        </div>
    </div>

    <!-- search recipes -->
    <div class="d-flex flex-column align-items-center justify-content-center gap-5 my-5">
        <div class="fs-2 fw-bold">
            Trouvez une recette
        </div>

        <div class="d-flex flex-column col-sm-4">
            <div class="border border-1 px-2 py-1 rounded-pill">
                <form method="GET" action="{{ route( 'searchResults.show' ) }}" class="col d-flex align-items-center justify-content-between gap-4">
                    @csrf
                    <input type="text" name="search" value="{{ old('search') }}" placeholder="Chercher une recette ..." class="form-control border border-0 shadow-none bg-transparent @error('search') is-invalid @enderror">

                    <button type="submit" class="d-flex justify-content-center align-items-center bg-transparent btn border border-0">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

            <p class="text-center mt-3">
                Exemple : Dessert, Plat, etc.
            </p>
        </div>
    </div>


    <!-- recipes -->
    <div class="container mt-12 mb-5">
        <div class="d-flex justify-content-between align-items-center">
                <div class="fs-2 fw-bold">
                    Nos recettes
                </div>

                <a href="" class="text-decoration-none d-flex gap-3 align-items-center">Voir plus <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="row row-cols-1 row-cols-md-4 g-4 mt-4">
            @foreach ($recipes as $recipe)
            @if ($recipe->completed === 1 && $recipe->visibility === 1)
            <div class="col">
                <div class="card position-relative rounded">
                    <a href="{{ route('recipe.show', ['recipeId' =>  $recipe->id]) }}">
                        <img src="{{ asset($recipe->image) }}" class="card-img-top recipe-image rounded" alt="Image de recette de cuisine">
                        <div class="card-img-overlay d-flex flex-column justify-content-end">
                            <h5 class="card-title text-white">{{ $recipe->recipename }}</h5>
                        </div>
                    </a>
                </div>
            </div>
            @endif
            @endforeach
        </div>

    </div>

    <!-- Espacement avant la section -->
    <div class="mt-11"></div>

    <!-- Section L'équipe ThecookTalk -->
    <div class="container mt-8 mb-4">
        <div class="fs-2 fw-bold text-center">
            L'équipe ThecookTalk
        </div>

        <div class="row mt-5">
            <!-- Description de l'équipe -->
            <div class="text-start fs-5 col-md-6 mb-5">
                "L'équipe ThecookTalk réunit des passionnés de technologie et de cuisine dévoués à offrir une expérience culinaire exceptionnelle. Nous sommes une équipe diversifiée de développeurs, designers et amateurs de cuisine unis par notre engagement à créer une plateforme conviviale et innovante. Notre mission est de permettre aux passionnés de partager leurs recettes, découvrir de nouvelles saveurs et se connecter avec une communauté mondiale de gastronomes. Avec la technologie comme alliée, nous aspirons à inspirer et rassembler les gens autour de la nourriture, pour créer la meilleure expérience culinaire possible."
            </div>


            <!-- Photos des membres de l'équipe -->
            <div class="col-md-6">
                <div class="row g-4">
                    <!-- Membre 1 -->
                    <div class="col-6">
                        <div class="text-center">
                            <img src="{{ asset('uploads/home/jawaad.jpg') }}" class="object-fit-cover rounded" width="200" height="200">
                            <div class="mt-2">
                                <h5 class="fw-bold">Jawaad Toure ALI</h5>
                                <p class="fw-semibold">Web Developer</p>
                            </div>
                        </div>
                    </div>
                    <!-- Membre 2 -->
                    <div class="col-6">
                        <div class="text-center">
                            <img src="{{ asset('uploads/home/baba.jpg') }}" class="object-fit-cover rounded" width="200" height="200">
                            <div class="mt-2">
                                <h5 class="fw-bold">Baptiste PESENTI</h5>
                                <p class="fw-semibold">Front-End Engineer</p>
                            </div>
                        </div>
                    </div>
                    <!-- Membre 3 -->
                    <div class="col-6">
                        <div class="text-center">
                            <img src="{{ asset('uploads/home/Cisse.jpg') }}" class="object-fit-cover rounded" width="200" height="200">
                            <div class="mt-2">
                                <h5 class="fw-bold">Ndieme CISSE</h5>
                                <p class="fw-semibold">Backend Engineer</p>
                            </div>
                        </div>
                    </div>
                    <!-- Membre 4 -->
                    <div class="col-6">
                        <div class="text-center">
                            <img src="{{ asset('uploads/home/warda.jpg') }}" class="object-fit-cover rounded" width="200" height="200">
                            <div class="mt-2">
                                <h5 class="fw-bold">Ouardia LABBACI</h5>
                                <p class="fw-semibold">Software Engineer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Espacement après la section -->
    <div class="mt-11"></div>


</div>

@endsection