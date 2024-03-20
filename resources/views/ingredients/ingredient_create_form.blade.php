@extends('base')

@section('content')

<div class="d-flex flex-column align-items-center mb-5">

    <h1 class="text-center py-4">Ajout d'ingrédient.s</h1>

    <form method="POST" action="" class="col-md-7">
        @csrf

        <div class="mb-5 d-flex flex-column">
            <!-- header -->
            <div class="py-3 border-bottom mb-3">
                <div class="fw-bold fs-6 align-self-center">
                    Ingrédients
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

            <div id="containerForIngredients">
                <div class="row row-cols-md-5 gx-2 mb-1">
                    <div class="my-1 col-md-7">
                        <input list="ingredients" name="ingredientname" value="{{ old('recipename') }}" placeholder="Saisissez un ingrédient" aria-describedby="ingredientname_feedback" class="col py-3 form-control shadow-none @error('ingredientname') is-invalid @enderror">
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
                        <input type="number" step="any" name="quantity" value="{{ old('quantity') }}" placeholder="100.00" aria-describedby="quantity_feedback" class="col py-3 form-control shadow-none @error('quantity') is-invalid @enderror">

                        @error('quantity')
                        <div id="cookingtype_feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="my-1 col-md-3">
                        <input list="units" name="unitname" value="{{ old('unitname') }}" placeholder="Saisissez une unité" aria-describedby="unitname_feedback" class="col py-3 form-control shadow-none @error('unitname') is-invalid @enderror">
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
                </div>
            </div>

            <button type="button" class="fw-bold btn  my-2 align-self-center btn-primary rounded-pill">
                Ajouter
            </button>

        </div>
    </form>

    <div id="containerForIngredientsList" class="row gy-2 mb-3">

    </div>

    <div class="col-md-7 d-flex justify-content-between align-items-center">
        <a href="{{ url()->previous() }}" class="fw-bold btn my-2">
            <i class="bi bi-arrow-left-square-fill"></i> Retour
        </a>


        <a href="#" class="fw-bold btn my-2">
            Suivant <i class="bi bi-arrow-right-square-fill"></i>
        </a>
    </div>

    @endsection