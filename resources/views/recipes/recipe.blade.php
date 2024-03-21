@extends('base')

@section('content')
<div class="row gy-3 mb-5">
    <h1 class="text-center fw-bold my-5">{{ $recipe->recipename }}</h1>

    <div class="d-flex justify-content-between mb-3">
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


    <div class="row gy-4">
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

    <div class="row gy-5">
        <h3 class="text-center fw-bold">Ingrédients</h3>

        <div class="d-flex justify-content-center align-items-center gap-3">
            <button type="button" class="btn d-flex justify-content-center align-items-center border border-0">
                <i class="bi bi-dash-square-fill"></i>
            </button>
            pour 1 personne
            <button type="button" class="btn d-flex justify-content-center align-items-center border border-0">
                <i class="bi bi-plus-square-fill"></i>
            </button>
        </div>

        <div class="d-flex justify-content-center align-items-center gap-5">
            @foreach ($recipeQuantities as $recipeQuantity)
            <div class="d-flex flex-column gap-2 border-3 border-start border-info px-3">
                <div class="text-start fw-semibold">
                    {{ $recipeQuantity->quantity }} {{ lcfirst($recipeQuantity->unitname) }}.s
                </div>
                <div class="text-start">
                    {{ $recipeQuantity->ingredientname }}
                </div>
                <div class="text-start">
                    ({{ $recipeQuantity->calorie }} calorie.s)
                </div>
            </div>
            @endforeach
        </div>
    </div>



</div>
@endsection