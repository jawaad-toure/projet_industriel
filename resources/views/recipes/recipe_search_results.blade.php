@extends('base')

@section('content')
<div class="d-flex flex-column gap-2">
    <div class="d-flex flex-column align-items-center justify-content-center gap-3 my-3">
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

            <p class="text-center mt-2">
                Exemple : Dessert, Plat, etc.
            </p>
        </div>
    </div>

    @if (count($searchResults) != 0)
    <div class="d-flex flex-column gap-4 my-3">
        @foreach ($searchResults as $searchResult)
        @if ($searchResult->completed === 1 && $searchResult->visibility === 1)
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex flex-column justify-content-start gap-2">
                <a href="{{ route( 'recipe.show', ['recipeId' => $searchResult->id] ) }}" class="fw-bold fs-3 text-primary">
                    {{ $searchResult->recipename }}
                </a>
                <div class="d-flex gap-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="material-symbols-outlined">
                            restaurant_menu
                        </span>
                    </div>{{ $searchResult->category }}
                </div>

                <div class="d-flex gap-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="material-symbols-outlined">
                            cooking
                        </span>
                    </div>{{ $searchResult->cookingtype }}
                </div>

                <div class="d-flex gap-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="bi bi-gear-fill"></i>
                    </div>{{ $searchResult->difficulty }}
                </div>

                <div class="d-flex gap-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="bi bi-alarm-fill"></i>
                    </div>{{ $searchResult->time }}
                </div>
            </div>
            <img src="{{ asset($searchResult->image) }}" class="object-fit-cover rounded mr-3" width="200" height="200" alt="avatar">
        </div>
        @endif
        @endforeach
    </div>
    @endif

    @if (empty($searchResults))
    <div class="text-center">Aucun résultat trouvé</div>
    @endif

</div>
@endsection