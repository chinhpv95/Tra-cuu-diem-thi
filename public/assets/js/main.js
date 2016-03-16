(function ($) {
    'use strict';

    //$.ajaxSetup({
    //    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    //});

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

    $('#auto').focus();

    $(function() {
        $(".delete").click(function(){
            var element = $(this);
            var del_id = element.attr("id");
            var info = 'id=' + del_id;
            if(confirm("Are you sure you want to delete this?"))
            {
                $.ajax({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                    type: "POST",
                    url: "delete",
                    data: info,
                    success: function(){
                    }
                });
                $(this).parents(".list-group-item").animate({ backgroundColor: "#003" }, "slow")
                    .animate({ opacity: "hide" }, "slow");
            }
            return false;
        });
    });
})(jQuery);