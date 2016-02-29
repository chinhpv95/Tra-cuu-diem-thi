jQuery(document).ready(function() {
    $('.select-option').on('click', function() {
        $(this).next().toggleClass('open-option');
    });
});