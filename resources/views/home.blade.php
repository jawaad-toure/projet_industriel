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
            <form method="" action="" class="d-flex align-items-center gap-4">
                @csrf
                <button type="button" class="btn btn-primary btn rounded-5 align-self-start fw-bold py-2 px-4">
                    Partagez une recette
                </button>
            </form>
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
                <form method="" action="" class="col d-flex align-items-center justify-content-between gap-4">
                    @csrf
                    <input type="text" placeholder="Chercher une recette ..." class="form-control border border-0 shadow-none bg-transparent" />

                    <button type="button" class="d-flex justify-content-center align-items-center bg-transparent btn border border-0">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

            <p class="text-center mt-3">
                Exemple : Dessert, Plat, etc.
            </p>
        </div>
    </div>


</div>

@endsection