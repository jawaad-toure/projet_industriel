$(document).ready(function () {
    $('#favoriteForm').on('submit', function (event) {
        event.preventDefault();

        var favoriteForm = $(this);

        $.ajax({
            url: favoriteForm.attr('action'),
            method: 'POST',
            data: favoriteForm.serialize(),
            success: function (response) {
                var heartButton = favoriteForm.find('#heartButton');
                var icon = heartButton.find('i');
                if (icon.hasClass('bi-heart')) {
                    icon.removeClass('bi-heart').addClass('bi-heart-fill');
                } else {
                    icon.removeClass('bi-heart-fill').addClass('bi-heart');
                }
            },
        });
    });
endfor

});

