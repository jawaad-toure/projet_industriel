@extends('base')

@section('content')

<div class="d-flex flex-column align-items-center mb-5">

    <h1 class="text-center py-4">Création d'une recette</h1>

    <!-- recipe form -->
    <form method="POST" action="{{ route('recipe.post', ['userId' => session()->get('user')['id']]) }}" class="col-md-7">
        @csrf

        <div class="mb-5 d-flex flex-column">

            @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }} &#9785;
            </div>
            @endif

            <!-- recipe name -->
            <div class="my-2">
                <input type="text" name="recipename" placeholder="Nom de la recette..." value="{{ old('recipename') }}" aria-describedby="recipename_feedback" class="py-3 form-control shadow-none @error('recipename') is-invalid @enderror" @if(session('recipe_submitted')) disabled @endif>

                @error('recipename')
                <div id="recipename_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- category, difficulty, time and cooking type -->
            <div class="row row-cols-md-2 gx-2 mb-3">

                <!-- category -->
                <div class="my-2">
                    <select name="category" aria-describedby="category_feedback" class="form-select py-3 form-control shadow-none @error('category') is-invalid @enderror" @if(session('recipe_submitted')) disabled @endif>
                        <option value="">Sélectionnez une catégorie</option>
                        <option value="Entrée" @if ( old('category')=='Entrée' ) selected @endif>Entrée</option>
                        <option value="Plat" @if ( old('category')=='Plat' ) selected @endif>Plat</option>
                        <option value="Dessert" @if ( old('category')=='Dessert' ) selected @endif>Dessert</option>
                        <option value="Boisson" @if ( old('category')=='Boisson' ) selected @endif>Boisson</option>
                    </select>

                    @error('category')
                    <div id="category_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- difficulty -->
                <div class="my-2">
                    <select name="difficulty" aria-describedby="difficulty_feedback" class="form-select py-3 form-control shadow-none @error('difficulty') is-invalid @enderror" @if(session('recipe_submitted')) disabled @endif>
                        <option value="">Sélectionnez un niveau</option>
                        <option value="Facile" @if ( old('difficulty')=='Facile' ) selected @endif>Facile</option>
                        <option value="Moyen" @if ( old('difficulty')=='Moyen' ) selected @endif>Moyen</option>
                        <option value="Difficile" @if ( old('difficulty')=='Difficile' ) selected @endif>Difficile</option>
                    </select>

                    @error('difficulty')
                    <div id="difficulty_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- time -->
                <div class="my-2">
                    <input type="text" name="time" pattern="[0-9]{2}:[0-9]{2}" value="{{ old('time') }}" placeholder="Temps de préparation (Format: 'HH:MM')" aria-describedby="time_feedback" class="py-3 form-control shadow-none @error('time') is-invalid @enderror" @if(session('recipe_submitted')) disabled @endif>

                    @error('time')
                    <div id="time_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- cooking type -->
                <div class="my-2">
                    <select name="cookingtype" aria-describedby="cookingtype_feedback" class="form-select py-3 form-control shadow-none @error('cookingtype') is-invalid @enderror" @if(session('recipe_submitted')) disabled @endif>
                        <option value="">Sélectionnez un type</option>
                        <option value="Four" @if ( old('cookingtype')=='Four' ) selected @endif>Four</option>
                        <option value="Barbecue" @if ( old('cookingtype')=='Barbecue' ) selected @endif>Barbecue</option>
                        <option value="Poele" @if ( old('cookingtype')=='Poele' ) selected @endif>Poele</option>
                        <option value="Vapeur" @if ( old('cookingtype')=='Vapeur' ) selected @endif>Vapeur</option>
                        <option value="Sans cuisson" @if ( old('cookingtype')=='Sans cuisson' ) selected @endif>Sans cuisson</option>
                    </select>

                    @error('cookingtype')
                    <div id="cookingtype_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-center gap-2">
                <a class="fw-bold btn btn-secondary" href="{{ route('dashboard.show', ['userId' => session()->get('user')['id']]) }}" role="button">
                    Retour
                </a>

                <button type="submit" class="fw-bold btn btn-success rounded" @if(session('recipe_submitted')) disabled @endif>
                    Valider
                </button>
            </div>
        </div>
    </form>

    <!-- ingredients form -->
    <form method="POST" action="" class="col-md-7">
        @csrf

        <div class="mb-5 d-flex flex-column">
            <!-- header -->
            <div class="d-flex justify-content-between py-2 border-bottom mb-3">
                <div class="fw-bold fs-6 align-self-center">
                    Ingrédients
                </div>
                <button type="button" id="btnAddIngredient" class="fw-bold btn btn-primary rounded-pill">Ajouter</button>
            </div>

            @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }} &#9785;
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }} &#128578;
            </div>
            @endif

            <div id="containerForIngredients">
                <div class="row row-cols-md-5 border-start border-info border-3 gx-2 mb-1">
                    <div class="my-1 col-md-6">
                        <input list="ingredients" name="ingredientname[]" value="{{ old('recipename') }}" placeholder="Saisissez un ingrédient" aria-describedby="ingredientname_feedback" class="col py-3 form-control shadow-none @error('ingredientname') is-invalid @enderror">
                        <datalist id="ingredients">
                            @foreach($ingredients as $ingredient)
                            <option value="{{ $ingredient->ingredientname }}">
                                @endforeach
                        </datalist>

                        @error('ingredientname')
                        <div id="cookingtype_feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="my-1 col-md-2">
                        <input type="number" step="any" name="quantity[]" value="{{ old('quantity') }}" placeholder="100.00" aria-describedby="quantity_feedback" class="col py-3 form-control shadow-none @error('quantity') is-invalid @enderror">

                        @error('quantity')
                        <div id="cookingtype_feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="my-1 col-md-3">
                        <input list="units" name="unitname[]" value="{{ old('unitname') }}" placeholder="Saisissez une unité" aria-describedby="unitname_feedback" class="col py-3 form-control shadow-none @error('unitname') is-invalid @enderror">
                        <datalist id="units">
                            @foreach($units as $unit)
                            @if ($unit->unitname != "Personne")
                            <option value="{{ $unit->unitname }}(s)">
                                @endif
                                @endforeach
                        </datalist>

                        @error('unitname')
                        <div id="cookingtype_feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="my-1 col-md-1 d-flex justify-content-center align-item-center">
                        <button type="button" class="btn btn-danger d-flex justify-content-center align-items-center btnRemoveIngredient">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="submit" class="fw-bold btn btn-success rounded-pill my-2 align-self-center">
                Valider
            </button>
        </div>
    </form>

    <!-- steps form-->
    <form method="POST" action="" class="col-md-7">
        <div class="mb-5 d-flex flex-column">
            <!-- header -->
            <div class="d-flex justify-content-between py-2 border-bottom mb-3">
                <div class="fw-bold fs-6 align-self-center">
                    Étapes
                </div>
                <button type="button" id="btnAddStep" class="fw-bold btn btn-primary rounded-pill">Ajouter</button>
            </div>

            @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }} &#9785;
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }} &#128578;
            </div>
            @endif

            <div id="containerForSteps">
                <div class="row row-cols-md-2 border-start border-info border-3 gx-2 mb-1">
                    <div class="my-1 col-md-11">
                        <textarea type="text" name="description[]" value="{{ old('description') }}" aria-describedby="description_feedback" class="py-3 form-control shadow-none @error('description') is-invalid @enderror"></textarea>
                    </div>

                    <div class="my-1 col-md-1 d-flex justify-content-center align-item-center">
                        <button type="button" class="btn btn-danger d-flex justify-content-center align-items-center btnRemoveStep">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="submit" class="fw-bold btn btn-success rounded-pill my-2 align-self-center">
                Valider
            </button>
        </div>
    </form>

    <!-- images form -->
    <div class="col-md-7">
        <div class="mb-5">
            <div class="d-flex justify-content-between py-3 border-bottom mb-3">
                <div class="fw-bold fs-6 align-self-center">
                    Images
                </div>
            </div>

            @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }} &#9785;
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }} &#128578;
            </div>
            @endif

            @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }} &#128578;
            </div>
            @endif

            <div class="d-flex flex-column justify-content-between gap-2 mb-3">
                <input type="file" name="image[]" accept="image/*" aria-describedby="avatar_feedback" class="form-control shadow-none @error('avatar_feedback') is-invalid @enderror">
                <form method="POST" action="" enctype="multipart/form-data" class="d-flex justify-content-center">
                    @csrf
                    <button type="button" class="fw-bold btn btn-success rounded-pill">
                        Valider
                    </button>
                </form>
            </div>

            <div id="containerForImages" class="row gy-2 mb-3">
                <div class="d-flex justify-content-between rounded">
                    <img src="{{ asset('uploads/recipes/default_recipe.png') }}" class="object-fit-cover" width="50" height="50" alt="image de recette">
                    <form method="POST" action="" class="d-grid">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger d-flex justify-content-center align-items-center btnRemoveImage">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection




<!-- buttons validate and back -->
<!-- <div class="d-flex justify-content-between gap-2">
    <button type="submit" class="btn btn-success btn-lg shadow-none">
        Valider
    </button>
    <a class="btn btn-secondary btn-lg" href="#" role="button">
        Retour
    </a>
</div> -->

<!--  -->