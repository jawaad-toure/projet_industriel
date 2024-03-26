@extends('base')

@section('content')
<div class="row gy-1 mb-5">
    <h1 class="text-center fw-bold mt-5">{{ $recipe->recipename }}</h1>

    <div class="d-flex flex-column gap-2 mb-3 px-md-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-center align-items-center gap-2">
                <div class="d-flex justify-content-center align-items-center gap-1 pb-1" id="rating-top">
                    <span class="star-comment fs-4 {{ $recipeAverageStars >= '1' ? 'good' : '' }}" data-rating="1">&#9733;</span>
                    <span class="star-comment fs-4 {{ $recipeAverageStars >= '2' ? 'good' : '' }}" data-rating="2">&#9733;</span>
                    <span class="star-comment fs-4 {{ $recipeAverageStars >= '3' ? 'good' : '' }}" data-rating="3">&#9733;</span>
                    <span class="star-comment fs-4 {{ $recipeAverageStars >= '4' ? 'good' : '' }}" data-rating="4">&#9733;</span>
                    <span class="star-comment fs-4 {{ $recipeAverageStars >= '5' ? 'good' : '' }}" data-rating="5">&#9733;</span>
                </div>

                <div class="d-flex justify-content-center align-items-center">
                    {{ number_format($recipeAverageStars, 1) }}/5
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center gap-2">
                <i class="bi bi-chat-left-text-fill"></i> @if ($recipeCommentsCount < 2) {{ $recipeCommentsCount }} commentaire @else {{ $recipeCommentsCount }} commentaires @endif </div>
            </div>
        </div>

        <div class="d-flex flex-column gap-3">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-inner border rounded">
                    @foreach ($recipeImages as $key => $recipeImage)
                    <div class="carousel-item @if ($key === 0) active @endif">
                        <img src="{{ asset($recipeImage->image) }}" class="d-block w-100 object-fit-cover" height="700" alt="Image de recette de cuisine">
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
                        {{ number_format($recipeQuantity->quantity, $recipeQuantity->quantity == (int)$recipeQuantity->quantity ? 0 : 2) }} @if ($recipeQuantity->quantity > 1) {{ $recipeQuantity->unitname }}s @else {{ $recipeQuantity->unitname }} @endif
                    </div>
                    <div class="">
                        {{ $recipeQuantity->ingredientname }}
                    </div>
                    <div class="">
                        {{ number_format($recipeQuantity->calorie, $recipeQuantity->calorie == (int)$recipeQuantity->calorie ? 0 : 2) }} @if ($recipeQuantity->calorie > 1) calories @else calorie @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="row gy-3 mb-5">
            <h3 class="text-center fw-bold">Préparation</h3>

            <div class="row gy-3 gx-5">
                @foreach ($recipeSteps as $recipeStep)
                <div class="text-start">
                    {{ $recipeStep->description }}
                </div>
                @endforeach
            </div>
        </div>

        <div class="row gy-3 mb-5 gx-5">
            <h3 class="text-center fw-bold">Votre avis nous intéresse</h3>

            <div class="d-flex justify-content-center align-items-center gap-3" id="rating-bottom">
                <a href="{{ route('starCommentForm.show', ['recipeId' => $recipe->id]) }}">
                    <span class="star-bottom fs-1" data-rating="1">&#9733;</span>
                </a>

                <a href="{{ route('starCommentForm.show', ['recipeId' => $recipe->id]) }}">
                    <span class="star-bottom fs-1" data-rating="2">&#9733;</span>
                </a>

                <a href="{{ route('starCommentForm.show', ['recipeId' => $recipe->id]) }}">
                    <span class="star-bottom fs-1" data-rating="3">&#9733;</span>
                </a>

                <a href="{{ route('starCommentForm.show', ['recipeId' => $recipe->id]) }}">
                    <span class="star-bottom fs-1" data-rating="4">&#9733;</span>
                </a>

                <a href="{{ route('starCommentForm.show', ['recipeId' => $recipe->id]) }}">
                    <span class="star-bottom fs-1" data-rating="5">&#9733;</span>
                </a>
            </div>
        </div>

        <div class="row gy-3 mb-5 gx-5">
            <h3 class="text-center fw-bold">Commentaires</h3>

            <div class="row gy-3">
                @foreach ($recipeStarscomments as $recipeStarscomment)
                @if (!is_null($recipeStarscomment->comment))
                <div class="d-flex justifiy-content-start align-items-start gap-3 mb-4">
                    <div class="d-flex justify-content-center align-items-center gap-3" id="rating-bottom">
                        <img src="{{ asset($recipeStarscomment->avatar ?? 'uploads/avatars/default_avatar.png') }}" width="50" height="50" class="object-fit-cover img-thumbnail rounded-circle">
                    </div>


                    <div class="row ">
                        <div class="fw-bold">
                            {{ $recipeStarscomment->username }}
                        </div>

                        <div class="d-flex justify-content-start align-items-center gap-1" id="rating-comment">
                            <span class="star-comment fs-4 {{ $recipeStarscomment->stars === '1' ? 'good' : '' }}" data-rating="1">&#9733;</span>
                            <span class="star-comment fs-4 {{ $recipeStarscomment->stars === '2' ? 'good' : '' }}" data-rating="2">&#9733;</span>
                            <span class="star-comment fs-4 {{ $recipeStarscomment->stars === '3' ? 'good' : '' }}" data-rating="3">&#9733;</span>
                            <span class="star-comment fs-4 {{ $recipeStarscomment->stars === '4' ? 'good' : '' }}" data-rating="4">&#9733;</span>
                            <span class="star-comment fs-4 {{ $recipeStarscomment->stars === '5' ? 'good' : '' }}" data-rating="5">&#9733;</span>
                        </div>

                        <div>
                            {{ $recipeStarscomment->comment }}
                        </div>

                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection


@extends('base')

@section('content')
<div class="row gy-4 mb-5">
    <h1 class="text-center fw-bold my-5">{{ $recipe->recipename }}</h1>

    <div class="d-flex justify-content-between mb-3 px-md-5">
        <div class="d-flex justify-content-center align-items-center gap-2">
            <div class="d-flex justify-content-center align-items-center gap-1 pb-1" id="rating-top">
                <span class="star-comment fs-4 {{ $recipeAverageStars >= '1' ? 'good' : '' }}" data-rating="1">&#9733;</span>
                <span class="star-comment fs-4 {{ $recipeAverageStars >= '2' ? 'good' : '' }}" data-rating="2">&#9733;</span>
                <span class="star-comment fs-4 {{ $recipeAverageStars >= '3' ? 'good' : '' }}" data-rating="3">&#9733;</span>
                <span class="star-comment fs-4 {{ $recipeAverageStars >= '4' ? 'good' : '' }}" data-rating="4">&#9733;</span>
                <span class="star-comment fs-4 {{ $recipeAverageStars >= '5' ? 'good' : '' }}" data-rating="5">&#9733;</span>
            </div>

            <div class="d-flex justify-content-center align-items-center">
                {{ number_format($recipeAverageStars, 1) }}/5
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center gap-2">
            <i class="bi bi-chat-left-text-fill"></i> @if ($recipeCommentsCount < 2) {{ $recipeCommentsCount }} commentaire @else {{ $recipeCommentsCount }} commentaires @endif </div>
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
                    <form id="favoriteForm" method="POST" action="{{ route('favorite.add') }}">
                        @csrf
                        <input type="hidden" name="recipeId" value="{{ $recipe->id }}">
                        <button id="heartButton" type="submit" class="btn d-flex justify-content-center align-items-center border border-0">
                            <i id="heartIcon" class="bi bi-heart-fill"></i>
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
                <button type="button" class="btn d-flex justify-content-center align-items-center border border-0" onclick="decrement()">
                    <i class="bi bi-dash-square-fill"></i>
                </button>
                <span id="recipeFor" data-initial="{{ $recipe->for }}">{{ $recipe->for }}</span> @if ($recipe->for > 1) {{ $recipeForUnitname }}s @else {{ $recipeForUnitname }} @endif
                <button type="button" class="btn d-flex justify-content-center align-items-center border border-0" onclick="increment()">
                    <i class="bi bi-plus-square-fill"></i>
                </button>
            </div>
    
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 gx-3 gy-3">
                @foreach ($recipeQuantities as $recipeQuantity)
                <div class="d-flex flex-column justify-content-center align-items-center gap-1 mt-5">
                    <div class="fw-semibold ingredient-quantity" data-initial="{{ $recipeQuantity->quantity }}" data-unit="{{ $recipeQuantity->unitname }}">
                        {{ number_format($recipeQuantity->quantity * $recipe->for, $recipeQuantity->quantity == (int)$recipeQuantity->quantity ? 0 : 2) }} @if ($recipeQuantity->quantity > 1) {{ $recipeQuantity->unitname }}s @else {{ $recipeQuantity->unitname }} @endif
                    </div>
                    <div class="">
                        {{ $recipeQuantity->ingredientname }}
                    </div>
                    <div class="">
                        {{ number_format($recipeQuantity->calorie * $recipe->for, $recipeQuantity->calorie == (int)$recipeQuantity->calorie ? 0 : 2) }} @if ($recipeQuantity->calorie > 1) calories @else calorie @endif
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

            <div class="d-flex justify-content-center align-items-center gap-3" id="rating-bottom">
                <a href="{{ route('starCommentForm.show', ['recipeId' => $recipe->id]) }}">
                    <span class="star-bottom fs-1" data-rating="1">&#9733;</span>
                </a>

                <a href="{{ route('starCommentForm.show', ['recipeId' => $recipe->id]) }}">
                    <span class="star-bottom fs-1" data-rating="2">&#9733;</span>
                </a>

                <a href="{{ route('starCommentForm.show', ['recipeId' => $recipe->id]) }}">
                    <span class="star-bottom fs-1" data-rating="3">&#9733;</span>
                </a>

                <a href="{{ route('starCommentForm.show', ['recipeId' => $recipe->id]) }}">
                    <span class="star-bottom fs-1" data-rating="4">&#9733;</span>
                </a>

                <a href="{{ route('starCommentForm.show', ['recipeId' => $recipe->id]) }}">
                    <span class="star-bottom fs-1" data-rating="5">&#9733;</span>
                </a>
            </div>
        </div>

        <div class="row gy-3 mb-5">
            <h3 class="text-center fw-bold">Commentaires</h3>

            <div class="row gy-3">
                @foreach ($recipeStarscomments as $recipeStarscomment)
                @if (!is_null($recipeStarscomment->comment))
                <div class="d-flex justifiy-content-start align-items-start gap-3 mb-4">
                    <div class="d-flex justify-content-center align-items-center gap-3" id="rating-bottom">
                        <img src="{{ asset($recipeStarscomment->avatar ?? 'uploads/avatars/default_avatar.png') }}" width="50" height="50" class="object-fit-cover img-thumbnail rounded-circle">
                    </div>


                    <div class="row ">
                        <div class="fw-bold">
                            {{ $recipeStarscomment->username }}
                        </div>

                        <div class="d-flex justify-content-start align-items-center gap-1" id="rating-comment">
                            <span class="star-comment fs-4 {{ $recipeStarscomment->stars === '1' ? 'good' : '' }}" data-rating="1">&#9733;</span>
                            <span class="star-comment fs-4 {{ $recipeStarscomment->stars === '2' ? 'good' : '' }}" data-rating="2">&#9733;</span>
                            <span class="star-comment fs-4 {{ $recipeStarscomment->stars === '3' ? 'good' : '' }}" data-rating="3">&#9733;</span>
                            <span class="star-comment fs-4 {{ $recipeStarscomment->stars === '4' ? 'good' : '' }}" data-rating="4">&#9733;</span>
                            <span class="star-comment fs-4 {{ $recipeStarscomment->stars === '5' ? 'good' : '' }}" data-rating="5">&#9733;</span>
                        </div>

                        <div>
                            {{ $recipeStarscomment->comment }}
                        </div>

                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection