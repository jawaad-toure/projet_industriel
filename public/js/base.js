$(document).ready(function () {
    setTimeout(function () {
        $('.alert').fadeOut();
    }, 5000);

    $(".btn-on").on('click', function () {
        $(this).addClass("btn-success").removeClass("btn-secondary");
        $(".btn-off").addClass("btn-secondary").removeClass("btn-danger");
    });

    $(".btn-off").on('click', function () {
        $(this).addClass("btn-danger").removeClass("btn-secondary");
        $(".btn-on").addClass("btn-secondary").removeClass("btn-success");
    });

    // for stars at the bottom of recipe page
    $('.star-bottom').hover(function(){
        var rating_bottom = $(this).data('rating');
        $('.star-bottom:lt(' + rating_bottom + ')').css('color', 'yellow');
    }, function(){
        $('.star-bottom').css('color', '');
    });

    // for stars at the top and in comments section of recipe page
    $('.star-comment').each(function() {
        if ($(this).hasClass('good')) {
            var rating = parseInt($(this).attr('data-rating'));
            for (var i = 1; i <= rating; i++) {
                $(this).parent().find('[data-rating="' + i + '"]').css('color', 'yellow');
            }
        }
    });
    
});





