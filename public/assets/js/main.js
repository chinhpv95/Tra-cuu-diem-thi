$(document).ready(function () {
    $('.select-option').on('click', function () {
        $(this).next().toggleClass('open-option');
    });

    $('.dropdown').hover(
        function () {
            $(this).children('.dropdown-menu').stop(true, false).slideDown(250);
        },
        function () {
            $(this).children('.dropdown-menu').stop(true, false).slideUp(250);
        }
    );
});