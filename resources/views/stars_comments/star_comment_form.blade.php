@extends('base')

@section('content')

<div class="d-flex flex-column gap-4 align-items-center mb-5">

    <h1 class="text-center fw-bold">Laissez un avis</h1>

    <!-- recipe form -->
    <form method="POST" action="{{ route('starComment.post', ['recipeId' => $recipeId]) }}" class="col-md-7">
        @csrf

        <div class="mb-5 d-flex flex-column gap-3">

            @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }} &#9785;
            </div>
            @endif

            <!-- stars -->
            <div class="my-2">
                <fieldset class="star-rating">
                    <input checked name="rating" value="0" type="radio" id="rating0">
                    <label for="rating0">
                        <span class="hide-visually">0 Stars</span>
                    </label>

                    <input name="rating" value="1" type="radio" id="rating1">
                    <label for="rating1">
                        <span class="hide-visually">1 Star</span>
                        <span aria-hidden="true" class="star">★</span>
                    </label>

                    <input name="rating" value="2" type="radio" id="rating2">
                    <label for="rating2">
                        <span class="hide-visually">2 Stars</span>
                        <span aria-hidden="true" class="star">★</span>
                    </label>

                    <input name="rating" value="3" type="radio" id="rating3">
                    <label for="rating3">
                        <span class="hide-visually">3 Stars</span>
                        <span aria-hidden="true" class="star">★</span>
                    </label>

                    <input name="rating" value="4" type="radio" id="rating4">
                    <label for="rating4">
                        <span class="hide-visually">4 Stars</span>
                        <span aria-hidden="true" class="star">★</span>
                    </label>

                    <input name="rating" value="5" type="radio" id="rating5">
                    <label for="rating5">
                        <span class="hide-visually">5 Stars</span>
                        <span aria-hidden="true" class="star">★</span>
                    </label>
                </fieldset>
            </div>

            <!-- comment -->
            <div class="">
                <textarea type="text" name="comment" placeholder="Laissez un commentaire" aria-describedby="comment_feedback" class="my-2 form-control shadow-none @error('comment') is-invalid @enderror">{{ old('description') }}</textarea>

                @error('comment')
                <div id="description_to_add_feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="d-flex justify-content-center alig-items-center gap-2">
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