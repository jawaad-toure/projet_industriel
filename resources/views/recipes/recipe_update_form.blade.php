@extends('base')

@section('content')

<div class="d-flex flex-column gap-4 align-items-center mb-5">

    <h1 class="text-center py-4">Mise à jour de la recette</h1>

    <!-- recipe form -->
    <form method="POST" action="{{ route('recipe.update', ['userId' => $userId, 'recipeId' => $recipe->id]) }}" class="container col-md-7">
        @csrf
        @method('PUT')

        <div class="mb-5 d-flex flex-column">
            <!-- header -->
            <div class="d-flex justify-content-between py-3 border-bottom mb-3">
                <div class="fw-bold fs-6 align-self-center">
                    Recette
                </div>
            </div>

            <span class="text-center align-self-center mb-3">
                &#9888; Dans les 2 derniers champs dites si c'est une recette pour N Personne.s ou pour une Boisson de N Litre.s
            </span>

            <!-- notifications -->
            @if (session('recipe_warning'))
            <div class="alert alert-warning">
                {{ session('recipe_warning') }} &#9785;
            </div>
            @endif

            @if(session('recipe_success'))
            <div class="alert alert-success">
                {{ session('recipe_success') }} &#128578;
            </div>
            @endif

            @if(session('info'))
            <div class="alert alert-info">
                {{ session('recipe_info') }} &#128578;
            </div>
            @endif

            <!-- recipe name -->
            <div class="my-2">
                <input type="text" name="recipename" placeholder="Nom de la recette..." value="{{ $recipe->recipename }}" aria-describedby="recipename_feedback" class="form-control shadow-none @error('recipename') is-invalid @enderror" @if(session('recipe_submitted')) disabled @endif>

                @error('recipename')
                <div id="recipename_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- category, difficulty, time and cooking type -->
            <div class="row row-cols-md-2 gy-2 gx-2 mb-2">

                <!-- category -->
                <div class="">
                    <select name="category" aria-describedby="category_feedback" class="form-select form-control shadow-none @error('category') is-invalid @enderror" @if(session('recipe_submitted')) disabled @endif>
                        <option value="">Sélectionnez une catégorie</option>
                        <option value="Entrée" @if ( $recipe->category === 'Entrée' ) selected @endif>Entrée</option>
                        <option value="Plat" @if ( $recipe->category === 'Plat' ) selected @endif>Plat</option>
                        <option value="Dessert" @if ( $recipe->category === 'Dessert' ) selected @endif>Dessert</option>
                        <option value="Boisson" @if ( $recipe->category === 'Boisson' ) selected @endif>Boisson</option>
                    </select>

                    @error('category')
                    <div id="category_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- difficulty -->
                <div class="">
                    <select name="difficulty" aria-describedby="difficulty_feedback" class="form-select form-control shadow-none @error('difficulty') is-invalid @enderror" @if(session('recipe_submitted')) disabled @endif>
                        <option value="">Sélectionnez la difficulté</option>
                        <option value="Facile" @if ( $recipe->difficulty === 'Facile' ) selected @endif>Facile</option>
                        <option value="Moyen" @if ( $recipe->difficulty === 'Moyen' ) selected @endif>Moyen</option>
                        <option value="Difficile" @if ( $recipe->difficulty ==='Difficile' ) selected @endif>Difficile</option>
                    </select>

                    @error('difficulty')
                    <div id="difficulty_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- time -->
                <div class="">
                    <input type="text" name="time" pattern="[01][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" value="{{ $recipe->time }}" placeholder="Temps de préparation (Format: 'HH:MM:SS')" aria-describedby="time_feedback" class="form-control shadow-none @error('time') is-invalid @enderror" @if(session('recipe_submitted')) disabled @endif>

                    @error('time')
                    <div id="time_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- cooking type -->
                <div class="">
                    <select name="cookingtype" aria-describedby="cookingtype_feedback" class="form-select form-control shadow-none @error('cookingtype') is-invalid @enderror" @if(session('recipe_submitted')) disabled @endif>
                        <option value="">Sélectionnez un type</option>
                        <option value="Four" @if ( $recipe->cookingtype === 'Four' ) selected @endif>Four</option>
                        <option value="Barbecue" @if ( $recipe->cookingtype === 'Barbecue' ) selected @endif>Barbecue</option>
                        <option value="Poele" @if ( $recipe->cookingtype === 'Poele' ) selected @endif>Poele</option>
                        <option value="Vapeur" @if ( $recipe->cookingtype === 'Vapeur' ) selected @endif>Vapeur</option>
                        <option value="Sans cuisson" @if ( $recipe->cookingtype === 'Sans cuisson' ) selected @endif>Sans cuisson</option>
                    </select>

                    @error('cookingtype')
                    <div id="cookingtype_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- for -->
                <div class="my-2">
                    <input type="number" name="for" value="{{ $recipe->for }}" placeholder="10" aria-describedby="for_feedback" class="col form-control shadow-none @error('for') is-invalid @enderror">
                </div>

                <!-- recipe unitname -->
                <div class="my-2">
                    <input list="units" name="id_unit" value="{{ $recipeUnitname }}" placeholder="Saisissez une unité" aria-describedby="id_unit_feedback" class="col form-control shadow-none @error('id_unit') is-invalid @enderror">
                    <datalist id="units">
                        @foreach($units as $unit)
                        <option>
                            {{ $unit->unitname }}
                        </option>
                        @endforeach
                    </datalist>
                </div>
            </div>

            <button type="submit" class="fw-bold btn btn-success rounded-pill my-2 align-self-center">
                Valider
            </button>
        </div>
    </form>

    <!-- ingredients quantities and units form -->
    <div class="container col-md-7">
        <div class="mb-5">

            <!-- header -->
            <div class="d-flex justify-content-between py-3 border-bottom mb-3">
                <div class="fw-bold fs-6 align-self-center">
                    Ingrédients
                </div>
            </div>


            <form method="POST" action="{{ route('quantity.post', ['userId' => $userId, 'recipeId' => $recipe->id]) }}" class="mb-3">
                @csrf

                <div class="d-flex flex-column">

                    @if (session('quantity_warning'))
                    <div class="alert alert-warning">
                        {{ session('quantity_warning') }} &#9785;
                    </div>
                    @endif

                    @if(session('quantity_success'))
                    <div class="alert alert-success">
                        {{ session('quantity_success') }} &#128578;
                    </div>
                    @endif

                    @if(session('quantity_info'))
                    <div class="alert alert-success">
                        {{ session('quantity_info') }} &#128578;
                    </div>
                    @endif

                    <div class="d-flex justify-content-center gap-2 my-2">
                        <div class="d-flex flex-column flex-grow-1">
                            <input list="ingredients" name="ingredientname" value="{{ old('ingredientname') }}" placeholder="Saisissez un ingrédient" aria-describedby="ingredientname_feedback" class="col form-control shadow-none @error('ingredientname') is-invalid @enderror">
                            <datalist id="ingredients">
                                @foreach($ingredients as $ingredient)
                                <option>
                                    {{ $ingredient->ingredientname }}
                                </option>
                                @endforeach
                            </datalist>
                        </div>

                        <div class="d-flex flex-column">
                            <input type="number" step="any" name="quantity" value="{{ old('quantity') }}" placeholder="100.00" aria-describedby="quantity_feedback" class="col form-control shadow-none @error('quantity') is-invalid @enderror">
                        </div>

                        <div class="d-flex flex-column">
                            <input list="units" name="unitname" value="{{ old('unitname') }}" placeholder="Saisissez une unité" aria-describedby="unitname_feedback" class="col form-control shadow-none @error('unitname') is-invalid @enderror">
                            <datalist id="units">
                                @foreach($units as $unit)
                                @if ($unit->unitname != "Personne")
                                <option>
                                    {{ $unit->unitname }}
                                </option>
                                @endif
                                @endforeach
                            </datalist>
                        </div>
                    </div>

                    <button type="submit" class="fw-bold btn btn-success rounded-pill my-2 align-self-center">
                        Valider
                    </button>
                </div>
            </form>

            <div id="containerForIngredients">
                @foreach ($recipeQuantities as $recipeQuantity)
                <div class="d-flex gap-2 mb-2">
                    <form method="POST" action="{{ route('quantity.update', ['userId' => $userId, 'recipeId' => $recipe->id, 'quantityId' => $recipeQuantity->id]) }}" class="d-flex justify-content-center gap-2">
                        @csrf
                        @method('PUT')

                        <div class="">
                            <input list="ingredients" name="ingredientname_to_update" value="{{ $recipeQuantity->ingredientname }}" placeholder="Saisissez un ingrédient" aria-describedby="ingredientname_to_update_feedback" class="col form-control shadow-none">
                            <datalist id="ingredients">
                                @foreach ($ingredients as $ingredient)
                                <option>
                                    {{ $ingredient->ingredientname }}
                                </option>
                                @endforeach
                            </datalist>
                        </div>

                        <div class="">
                            <input type="number" step="any" name="quantity_to_update" value="{{ $recipeQuantity->quantity }}" placeholder="100.00" aria-describedby="quantity_to_update_feedback" class="col form-control shadow-none">
                        </div>

                        <div class="">
                            <input list="units" name="unitname_to_update" value="{{ $recipeQuantity->unitname }}" placeholder="Saisissez une unité" aria-describedby="unitname_to_update_feedback" class="col form-control shadow-none">
                            <datalist id="units">
                                @foreach ($units as $unit)
                                @if ($unit->unitname != "Personne")
                                <option>
                                    {{ $unit->unitname }}
                                </option>
                                @endif
                                @endforeach
                            </datalist>
                        </div>

                        <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center">
                            <i class="bi bi-floppy-fill"></i>
                        </button>
                    </form>

                    <form method="POST" action="{{ route('quantity.delete', ['userId' => $userId, 'recipeId' => $recipe->id, 'quantityId' => $recipeQuantity->id]) }}" class="d-grid">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger d-flex justify-content-center align-items-center">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- steps form-->
    <div class="container col-md-7">
        <div class="mb-5">

            <!-- header -->
            <div class="d-flex justify-content-between py-3 border-bottom mb-3">
                <div class="fw-bold fs-6 align-self-center">
                    Étapes
                </div>
            </div>

            <form method="POST" action="{{ route('step.post', ['userId' => $userId, 'recipeId' => $recipe->id]) }}" class="mb-3">
                @csrf

                <div class="d-flex flex-column">
                    <!-- notifications -->
                    @if (session('step_warning'))
                    <div class="alert alert-warning">
                        {{ session('step_warning') }} &#9785;
                    </div>
                    @endif

                    @if (session('step_success'))
                    <div class="alert alert-success">
                        {{ session('step_success') }} &#128578;
                    </div>
                    @endif

                    @if(session('step_info'))
                    <div class="alert alert-info">
                        {{ session('step_info') }} &#128578;
                    </div>
                    @endif

                    @error('description_to_update')
                    <div class="alert alert-warning">
                        {{ $message }} &#9785;
                    </div>
                    @enderror

                    <!-- textarea -->
                    <textarea type="text" name="description_to_add" placeholder="Entrez une description" aria-describedby="description_to_add_feedback" class="my-2 form-control shadow-none @error('description_to_add') is-invalid @enderror">{{ old('description') }}</textarea>

                    @error('description_to_add')
                    <div id="description_to_add_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                    <button type="submit" class="fw-bold btn btn-success rounded-pill my-2 align-self-center">
                        Valider
                    </button>
                </div>
            </form>

            <div id="containerForSteps">
                @foreach ($recipeSteps as $recipeStep)
                <div class="d-flex gap-2 mb-2">
                    <form method="POST" action="{{ route('step.update', ['userId' => $userId, 'recipeId' => $recipe->id, 'stepId' => $recipeStep->id]) }}" class="d-flex gap-2">
                        @csrf
                        @method('PUT')

                        <textarea type="text" name="description_to_update" cols="110" aria-describedby="description_to_update_feedback" class="text-start form-control shadow-none">{{ $recipeStep->description }}</textarea>

                        <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center">
                            <i class="bi bi-floppy-fill"></i>
                        </button>
                    </form>

                    <form method="POST" action="{{ route('step.delete', ['userId' => $userId, 'recipeId' => $recipe->id, 'stepId' => $recipeStep->id]) }}" class="d-grid">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger d-flex justify-content-center align-items-center">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- images form -->
    <div class="container col-md-7">
        <div class="mb-5">
            <div class="d-flex justify-content-between py-3 border-bottom mb-3">
                <div class="fw-bold fs-6 align-self-center">
                    Images
                </div>
            </div>

            <form method="POST" action="{{ route('image.post', ['userId' => $userId, 'recipeId' => $recipe->id]) }}" enctype="multipart/form-data" class="d-flex flex-column gap-2 mb-3">
                @csrf

                @if (session('image_warning'))
                <div class="alert alert-warning">
                    {{ session('image_warning') }} &#9785;
                </div>
                @endif

                @if(session('image_success'))
                <div class="alert alert-success">
                    {{ session('image_success') }} &#128578;
                </div>
                @endif

                @if(session('image_info'))
                <div class="alert alert-info">
                    {{ session('image_info') }} &#128578;
                </div>
                @endif

                <input type="file" name="images[]" accept="image/*" aria-describedby="images_feedback" class="my-2 form-control shadow-none @error('images_feedback') is-invalid @enderror" multiple>

                <button type="submit" class="fw-bold btn btn-success rounded-pill align-self-center">
                    Valider
                </button>
            </form>

            <div id="containerForImages" class="row gy-2 mb-3">
                @foreach ($recipeImages as $recipeImage)
                <div class="d-flex justify-content-between rounded">
                    <img src="{{ asset($recipeImage->image) }}" class="object-fit-cover" width="50" height="50" alt="image de recette">

                    <form method="POST" action="{{ route('image.delete', ['userId' => $userId, 'recipeId' => $recipe->id, 'imageId' => $recipeImage->id]) }}" class="d-grid">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger d-flex justify-content-center align-items-center">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection