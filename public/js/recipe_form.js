$(document).ready(function() {
    // add and delete ingredient field
    if ($('#containerForIngredients .row').length === 1) {
        $('#containerForIngredients .btnRemoveIngredient').prop('disabled', true);
    }

    // add
    $('#btnAddIngredient').on('click', function() {
        var clone = $('#containerForIngredients .row').first().clone();
        $('#containerForIngredients').append(clone);
        $('#containerForIngredients .btnRemoveIngredient').prop('disabled', false); 
    });

    // delete
    $(document).on('click', '.btnRemoveIngredient', function() {
        $(this).closest('.row').remove();
        $('#btnAddIngredient').prop('disabled', false);

        if ($('#containerForIngredients .row').length === 1) {
            $('.btnRemoveIngredient').prop('disabled', true);
        }
    });

    // add and delete step field
    if ($('#containerForSteps .row').length === 1) {
        $('#containerForSteps .btnRemoveStep').prop('disabled', true);
    }

    // add
    $('#btnAddStep').click(function() {
        var clone = $('#containerForSteps .row').first().clone();
        $('#containerForSteps').append(clone);
        $('#containerForSteps .btnRemoveStep').prop('disabled', false);
    });

    // delete
    $(document).on('click', '.btnRemoveStep', function() {
        $(this).closest('.row').remove();
        $('#btnAddStep').prop('disabled', false);

        if ($('#containerForSteps .row').length === 1) {
            $('.btnRemoveStep').prop('disabled', true);
        }
    });
});


// $(document).ready(function(){

//     var ingredientTemplate = `
//         <div class="row row-cols-md-5 border-start border-info border-3 gx-2 mb-1">
//             <div class="form-group my-1 col-md-6">
//                 <select name="ingredientname" aria-describedby="ingredientname_feedback" class="col form-select py-3 form-control shadow-none">
//                     <option selected>Sélectionnez un ingrédient</option>

//                     @foreach($ingredients as $ingredient)
//                     <option value="{{ $ingredient->id }}">
//                         {{ ucfirst($ingredient->ingredientname) }}
//                     </option>
//                     @endforeach
//                 </select>
//             </div>

//             <div class="form-group my-1 col-md-2">
//                 <input type="number" step="any" name="quantity" placeholder="100" aria-describedby="quantity_feedback" class="col py-3 form-control shadow-none">
//             </div>

//             <div class="form-group my-1 col-md-3">
//                 <select name="unit" aria-describedby="unit_feedback" class="col form-select py-3 form-control shadow-none">
//                     <option value="" selected>Unité</option>

//                     @foreach($units as $unit)
//                     @if ($unit->unit != "personne")
//                     <option value="{{ $unit->id }}">
//                         {{ ucfirst($unit->unit) }}
//                     </option>
//                     @endif
//                     @endforeach
//                 </select>
//             </div>

//             <div class="form-group my-1 col-md-1 d-flex justify-content-center align-item-center">
//                 <button type="button" class="btn btn-danger d-flex justify-content-center align-items-center btnRemoveIngredient">
//                     <i class="bi bi-trash"></i>
//                 </button>
//             </div>
//         </div>
//     `;

//     $("#btnAddIngredient").on('click', function(){
//         $('#containerForIngredients').append(ingredientTemplate);
//     });

//     $('#containerForIngredients').on('click', '.btnRemoveIngredient', function() {
//         $(this).closest('.row').remove();
//     });
// });



{/* <div class="row row-cols-md-5 border-start border-info border-3 gx-2 mb-1">
<div class="form-group my-1 col-md-6">
    <select name="ingredientname" value="{{ old('recipename') }}" aria-describedby="ingredientname_feedback" class="col form-select py-3 form-control shadow-none @error('ingredientname') is-invalid @enderror">
        <option selected>Sélectionnez un ingrédient</option>

        @foreach($ingredients as $ingredient)
        <option value="{{ $ingredient->id }}">
            {{ ucfirst($ingredient->ingredientname) }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group my-1 col-md-2">
    <input type="number" step="any" name="quantity" value="{{ old('quantity') }}" placeholder="100" aria-describedby="quantity_feedback" class="col py-3 form-control shadow-none @error('quantity') is-invalid @enderror">
</div>

<div class="form-group my-1 col-md-3">
    <select name="unit" value="{{ old('unit') }}" aria-describedby="unit_feedback" class="col form-select py-3 form-control shadow-none @error('unit') is-invalid @enderror">
        <option value="" selected>Unité</option>

        @foreach($units as $unit)
        @if ($unit->unit != "personne")
        <option value="{{ $unit->id }}">
            {{ ucfirst($unit->unit) }}
        </option>
        @endif
        @endforeach
    </select>
</div>

<div class="form-group my-1 col-md-1 d-flex justify-content-center align-item-center">
    <button type="button" class="btn btn-danger d-flex justify-content-center align-items-center">
        <i class="bi bi-trash"></i>
    </button>
</div>
</div> */}
