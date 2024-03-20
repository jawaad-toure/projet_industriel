$(document).ready(function () {
    setTimeout(function () {
        $('.alert').fadeOut();
    }, 5000);

    $(".btn-on").on('click', function() {
        $(this).addClass("btn-success").removeClass("btn-secondary");
        $(".btn-off").addClass("btn-secondary").removeClass("btn-danger");
    });

    $(".btn-off").on('click', function() {
        $(this).addClass("btn-danger").removeClass("btn-secondary");
        $(".btn-on").addClass("btn-secondary").removeClass("btn-success");
    });
});





