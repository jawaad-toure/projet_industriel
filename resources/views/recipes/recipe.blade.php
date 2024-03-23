@extends('base')

@section('content')
<div class="row gy-4 mb-5">
    <h1 class="text-center fw-bold my-5">{{ $recipe->recipename }}</h1>

    <div class="d-flex justify-content-between mb-3 px-md-5">
        <div>
            <i class="bi bi-star"></i>
            <i class="bi bi-star"></i>
            <i class="bi bi-star"></i>
            <i class="bi bi-star"></i>
            <i class="bi bi-star"></i> 4.5/5
        </div>

        <div class="d-flex gap-2">
            <i class="bi bi-chat-left-text-fill"></i> 10 commentaire.s
        </div>
    </div>


    <div class="row gy-3 mb-5">
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-inner">
                @foreach ($recipeImages as $key => $recipeImage)
                <div class="carousel-item @if ($key === 0) active @endif">
                    <img src="{{ asset($recipeImage->image) }}" class="d-block w-100 object-fit-contain" height="500" alt="Image de recette de cuisine">
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="d-flex justify-content-around align-items-center">
            <div class="d-flex gap-2">
                <i class="bi bi-alarm-fill"></i> {{ $recipe->time }}
            </div>
            <div class="d-flex gap-2">
                <span class="material-symbols-outlined">
                    restaurant_menu
                </span></i>{{ $recipe->category }}
            </div>
            <div class="d-flex gap-2">
                <form method="POST" action="">
                    @csrf

                    <button type="button" class="btn d-flex justify-content-center align-items-center border border-0">
                        <i class="bi bi-heart"></i>
                    </button>
                </form>
            </div>
            <div class="d-flex gap-2">
                <i class="bi bi-gear-fill"></i>{{ $recipe->difficulty }}
            </div>
            <div class="d-flex gap-2">
                <span class="material-symbols-outlined">
                    cooking
                </span>{{ $recipe->cookingtype }}
            </div>
        </div>
    </div>

    <div class="row gy-3 mb-5">
        <h3 class="text-center fw-bold">Ingrédients</h3>

        <div class="d-flex justify-content-center align-items-center gap-3">
            <button type="button" class="btn d-flex justify-content-center align-items-center border border-0">
                <i class="bi bi-dash-square-fill"></i>
            </button>
            {{ $recipe->for }} @if ($recipe->for > 1) {{ $recipeForUnitname }}s @else {{ $recipeForUnitname }} @endif
            <button type="button" class="btn d-flex justify-content-center align-items-center border border-0">
                <i class="bi bi-plus-square-fill"></i>
            </button>
        </div>

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 gx-3 gy-3">
            @foreach ($recipeQuantities as $recipeQuantity)
            <div class="d-flex flex-column justify-content-center align-items-center gap-1 mt-5">
                <div class="fw-semibold">
                    {{ $recipeQuantity->quantity }} @if ($recipeQuantity->quantity > 1) {{ $recipeQuantity->unitname }}s @else {{ $recipeQuantity->unitname }} @endif
                </div>
                <div class="">
                    {{ $recipeQuantity->ingredientname }}
                </div>
                <div class="">
                    {{ $recipeQuantity->calorie }} @if ($recipeQuantity->calorie > 1) calories @else calorie @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="row gy-3 mb-5">
        <h3 class="text-center fw-bold">Préparation</h3>

        <div class="row gy-3">
            @foreach ($recipeSteps as $recipeStep)
            <div class="text-start">
                {{ $recipeStep->description }}
            </div>
            @endforeach
        </div>
    </div>

    <div class="row gy-3 mb-5">
        <h3 class="text-center fw-bold">Votre avis nous intéresse</h3>

        <div class="d-flex justify-content-center align-items-center gap-3" id="rating">
            <a href="{{ route('starCommentForm.show', ['recipeId' => $recipe->id]) }}">
                <span class="star fs-1" data-rating="1">&#9733;</span>
            </a>

            <a href="{{ route('starCommentForm.show', ['recipeId' => $recipe->id]) }}">
                <span class="star fs-1" data-rating="2">&#9733;</span>
            </a>

            <a href="{{ route('starCommentForm.show', ['recipeId' => $recipe->id]) }}">
                <span class="star fs-1" data-rating="3">&#9733;</span>
            </a>

            <a href="{{ route('starCommentForm.show', ['recipeId' => $recipe->id]) }}">
                <span class="star fs-1" data-rating="4">&#9733;</span>
            </a>

            <a href="{{ route('starCommentForm.show', ['recipeId' => $recipe->id]) }}">
                <span class="star fs-1" data-rating="5">&#9733;</span>
            </a>
        </div>
    </div>

    <div class="row gy-3 mb-5">
        <h3 class="text-center fw-bold">Commentaires</h3>

        <div class="row gy-3">
            @foreach ($recipeSteps as $recipeStep)
            <div class="text-start">
                {{ $recipeStep->description }}
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection