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
    $(function(){
        var req = null;
        $('#keysearch').on('keyup', function(){
            var key = $('#keysearch').val();
            if (key && key.length > 0)
            {
                $('#loading').css('display', 'block');
                if (req)
                    req.abort();
                req = $.ajax({
                    url : 'search_class',
                    type : 'POST',
                    cache : false,
                    data : {
                        keysearch : key
                    },
                    success : function(data)
                    {
                        if (data)
                        {
                            $('#loading').css('display', 'none');
                            $('.list-classes .list-group-item').css('display', 'none');
                            for( var i=0; i<data.length; i++) {
                                $('.list-classes .list-group-item').each(function() {
                                    if( $(this).attr('data-id') == data[i]['class_id'] ) {
                                        $(this).css('display', 'block');
                                    }
                                });
                            }
                        }
                    }
                });
            }
            else
            {
                $('#loading').css('display', 'none');
                $('.list-classes .list-group-item').css('display', 'block');
            }

        });
    });
})(jQuery);