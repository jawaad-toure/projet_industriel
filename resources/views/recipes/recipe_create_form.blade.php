@extends('base')

@section('content')

<div class="d-flex flex-column gap-4 align-items-center mb-5">

    <h1 class="fw-bold text-center py-4">Création d'une recette</h1>

    <span class="text-center align-self-center col-7">
        &#9888; Dans les 2 derniers champs dites si c'est une recette pour N Personne.s ou pour une Boisson de N Litre.s
    </span>

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
                <input type="text" name="recipename" placeholder="Nom de la recette..." value="{{ old('recipename') }}" aria-describedby="recipename_feedback" class="py-3 form-control shadow-none @error('recipename') is-invalid @enderror">

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
                    <select name="category" aria-describedby="category_feedback" class="form-select py-3 form-control shadow-none @error('category') is-invalid @enderror">
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
                    <select name="difficulty" aria-describedby="difficulty_feedback" class="form-select py-3 form-control shadow-none @error('difficulty') is-invalid @enderror">
                        <option value="">Sélectionnez la difficulté</option>
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
                    <input type="text" name="time" pattern="[01][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" value="{{ old('time') }}" placeholder="Temps de préparation (Format: 'HH:MM:SS')" aria-describedby="time_feedback" class="py-3 form-control shadow-none @error('time') is-invalid @enderror">

                    @error('time')
                    <div id="time_feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- cooking type -->
                <div class="my-2">
                    <select name="cookingtype" aria-describedby="cookingtype_feedback" class="form-select py-3 form-control shadow-none @error('cookingtype') is-invalid @enderror">
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

                <!-- for -->
                <div class="my-2">
                    <input type="number" name="for" value="{{ old('for') }}" placeholder="10" aria-describedby="for_feedback" class="col form-control py-3 shadow-none @error('for') is-invalid @enderror">
                </div>

                <!-- recipe unitname -->
                <div class="my-2">
                    <input list="units" name="id_unit" value="{{ old('id_unit') }}" placeholder="Saisissez une unité" aria-describedby="id_unit_feedback" class="col form-control py-3 shadow-none @error('id_unit') is-invalid @enderror">
                    <datalist id="units">
                        @foreach($units as $unit)
                        <option>
                            {{ $unit->unitname }}
                        </option>
                        @endforeach
                    </datalist>
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center gap-2">
                <a class="fw-bold btn btn-secondary" href="{{ url()->previous() }}" role="button">
                    Retour
                </a>

                <button type="submit" class="fw-bold btn btn-success rounded">
                    Valider
                </button>
            </div>
        </div>
    </form>
</div>

@endsection