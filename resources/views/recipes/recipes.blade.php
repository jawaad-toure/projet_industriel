@extends('base')

@section('content')


<div class="row gy-2 mb-5">
    <h1 class="text-center fw-bold my-5">Découvrez nos recettes</h1>

    <!-- Affichage du temps de préparation moyen -->
    @php
    $totalMinutes = 0;
    $averageTime = 0; // Initialiser la moyenne à zéro par défaut

    if (!empty($recipes)) { // Vérifier si le tableau de recettes n'est pas vide
    foreach($recipes as $recipe) {
    $timeArray = explode(':', $recipe->time);
    $totalMinutes += intval($timeArray[0]) * 60 + intval($timeArray[1]);
    }

    $averageTime = $totalMinutes / max(count($recipes), 1); // Utilisez max pour éviter la division par zéro
    }

    // Formatage du temps de préparation moyen
    $formattedAverageTime = ($averageTime >= 60) ? floor($averageTime / 60) . ' hr' : $averageTime . ' min';
    @endphp

    @foreach($recipes as $key => $recipe)
    @if($key % 3 == 0) <!-- Ouvre une nouvelle ligne toutes les trois recettes -->

    <div class="row gy-2 mb-5">
        @endif
        <div class="col-md-4">
            <div class="card h-100 recipe-card">
                @if($recipe->images && !$recipe->images->isEmpty())
                <div id="carousel-{{ $recipe->id }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($recipe->images as $imgKey => $image)
                        <div class="carousel-item {{ $imgKey == 0 ? 'active' : '' }}">
                            <img src="{{ asset($image->image) }}" class="d-block w-100 recipe-image img-fluid rounded-top" alt="{{ $recipe->recipename }}"> <!-- Ajout de la classe "img-fluid" pour rendre les images réactives -->
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $recipe->id }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $recipe->id }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                @endif
                <div class="card-body recipe-info">
                    <h5 class="card-title fw-semibold text-center mb-3">{{ $recipe->recipename }}</h5>

                    <div class="recipe-details d-flex justify-content-between">
                        <!-- Affichage du temps de préparation -->
                        <div class="d-flex gap-2">
                            <i class="bi bi-alarm-fill"></i>
                            @php
                            // Convertir le temps au format désiré
                            $timeArray = explode(':', $recipe->time); // Divisez le temps en heures, minutes et secondes
                            $timeInMinutes = intval($timeArray[0]) * 60 + intval($timeArray[1]); // Convertir le temps total en minutes
                            $formattedTime = ($timeInMinutes >= 60) ? floor($timeInMinutes / 60) . ' hr' : $timeInMinutes . ' min'; // Convertir les minutes en heures si nécessaire
                            // Affichez le temps formaté
                            echo $formattedTime;
                            @endphp
                        </div>

                        <div class="d-flex gap-2">
                            <span class="material-symbols-outlined">
                                restaurant_menu
                            </span>{{ $recipe->category }}
                        </div>
                        <div class="d-flex gap-2">
                            <span class="material-symbols-outlined">
                                cooking
                            </span>{{ $recipe->cookingtype }}
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mb-3 px-md-5"> <!-- Utilisez justify-content-center pour centrer horizontalement -->
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <div class="d-flex justify-content-center align-items-center gap-1 pb-1" id="rating-top">
                                @php
                                // Calcul du nombre d'étoiles remplies
                                $filledStars = min(round($recipe->ratings->avg('stars')), 5);
                                @endphp
                                @for ($i = 1; $i <= 5; $i++) @if ($i <=$filledStars) <!-- Étoile pleine -->
                                    <span class="star-comment text-center fs-2 good" data-rating="{{ $i }}">&#9733;</span>
                                    @else
                                    <!-- Étoile vide -->
                                    <span class="star-comment text-center fs-2" data-rating="{{ $i }}">&#9734;</span>
                                    @endif
                                    @endfor
                            </div>

                            <div class="d-flex justify-content-center align-items-center"> <!-- Centrer le texte à l'intérieur du rating -->
                                {{ number_format($recipe->ratings->avg('stars'), 1) }}/5
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('recipe.show', ['recipeId' => $recipe->id]) }}" class="btn btn-success btn-voir-recette">Voir la recette</a>
                    </div>
                </div>
            </div>
        </div>
        @if(($key + 1) % 3 == 0 || $loop->last) <!-- Ferme la ligne après chaque troisième recette ou si c'est la dernière recette -->
    </div>
    @endif
    @endforeach
</div>
@endsection