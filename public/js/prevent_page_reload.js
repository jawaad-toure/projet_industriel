$(document).ready(function () {

    // $('#favoriteForm').on('submit', function (event) {
    //     event.preventDefault();

    //     var favoriteForm = $(this);

    //     $.ajax({
    //         url: favoriteForm.attr('action'),
    //         method: 'POST',
    //         data: favoriteForm.serialize(),
    //         success: function (response) {
    //             var heartButton = favoriteForm.find('#heartButton');
    //             var icon = heartButton.find('i');
    //             if (icon.hasClass('bi-heart')) {
    //                 icon.removeClass('bi-heart').addClass('bi-heart-fill');
    //             } else {
    //                 icon.removeClass('bi-heart-fill').addClass('bi-heart');
    //             }
    //         },
    //     });
    // });

    $('#visibilityOnForm').on('submit', function (event) {
        event.preventDefault();
        var visibilityOnForm = $(this);
        $.ajax({
            url: visibilityOnForm.attr('action'),
            type: visibilityOnForm.attr('method'),
            data: visibilityOnForm.serialize(),
            success: function(response) {
                var visibility = response.visibility;
                var btnOn = form.find('.btn-on');

                if (visibility === 1) {
                    btnOn.addClass('is-public');
                } else {
                    btnOn.removeClass('is-public');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    $('#visibilityOffForm').on('submit', function (event) {
        event.preventDefault();
        var visibilityOffForm = $(this);
        $.ajax({
            url: visibilityOffForm.attr('action'),
            type: visibilityOffForm.attr('method'),
            data: visibilityOffForm.serialize(),
            success: function(response) {
                var visibility = response.visibility;
                var btnOff = visibilityOffForm.find('.btn-off');

                if (visibility === 0) {
                    btnOff.addClass('is-private');
                } else {
                    btnOff.removeClass('is-private');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

});


    

