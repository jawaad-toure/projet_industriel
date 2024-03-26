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
