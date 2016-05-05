(function ($) {
    'use strict';

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


    $('#checkAllYear').change(function() {
    var checkboxes = $(this).closest('form').find(':checkbox');
    if($(this).is(':checked')) {
        checkboxes.prop('checked', true);
    } else {
        checkboxes.prop('checked', false);
    }
});
    $('#checkAllUser').change(function() {
    var checkboxes = $(this).closest('form').find(':checkbox');
    if($(this).is(':checked')) {
        checkboxes.prop('checked', true);
    } else {
        checkboxes.prop('checked', false);
    }
});

    $(function () {
        $(".list-user .delete").click(function () {
            var element = $(this);
            var del_id = element.attr("id");
            var info = 'id=' + del_id;
            if (confirm("Are you sure you want to delete this?")) {
                $.ajax({
                    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                    type: "POST",
                    url: "delete",
                    data: info,
                    success: function () {

                    }
                });
                $(this).parents(".list-group-item").animate({backgroundColor: "#003"}, "slow")
                    .animate({opacity: "hide"}, "slow");
            }
            return false;
        });
    });

    $(function () {
        $(".list-group-item .sendemail").click(function () {
            var element = $(this);
            var del_id = element.attr("id");
            var info = 'id=' + del_id;
            if (confirm("Are you sure you want to send mail?")) {
                $.ajax({
                    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                    type: "POST",
                    url: "sendemail",
                    data: info,
                    success: function () {
                        var mess = 'Send Email Successfully';
                        $(".send-email-success").append(mess);
                    }
                });
            }
            return false;
        });
    });


    $(function () {
        $('.list-years .year_delete').click(function () {
            var element = $(this);
            var del_id = element.attr("id");
            var info = 'id=' + del_id;
            if (confirm("Are you sure you want to delete this?")) {
                $.ajax({
                    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                    type: "POST",
                    url: "delete_year",
                    data: info,
                    success: function () {
                    }
                });
                $(this).parents(".list-group-item").animate({backgroundColor: "#003"}, "slow")
                    .animate({opacity: "hide"}, "slow");
            }
            return false;
        });
    });

    $(function () {
        var req = null;
        $('#keysearch').on('keyup', function () {
            var key = $('#keysearch').val();
            if (key && key.length > 0) {
                $('#loading').css('opacity', '1');
                if (req)
                    req.abort();
                req = $.ajax({
                    url: 'search_class',
                    type: 'POST',
                    cache: false,
                    data: {
                        keysearch: key
                    },
                    success: function (data) {
                        if (data) {
                            $('#loading').css('opacity', '0');
                            $('.list-classes').html(data);
                        } else {
                            $('#loading').css('opacity', '0');
                            $('.list-classes').html('<h3>Không có môn học phù hợp</h3>');
                        }
                    }
                });
            }
            else {
                $('#loading').css('opacity', '0');
            }

        });
    });

    $(function ($) {
        $('.filter-class').click(function () {
            var filter_year = $('.filter-year').val();
            var filter_semester = $('.filter-semester').val();
            $.ajax({
                url: 'admin/filter_class',
                type: 'POST',
                cache: false,
                data: {
                    filter_year: filter_year,
                    filter_semester: filter_semester
                },
                success: function (data) {
                    if (data) {
                        $('.list-classes').html(data);
                    } else {
                        $('.list-classes').html('<h3>Không tồn tại danh sách môn học</h3>');
                    }
                },
                error: function () {
                    alert('Da co loi xay ra');
                }
            });
        });
    });

    $(function () {
        $(document).on('change', '.image-avatar .btn-file :file', function () {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function (event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });
    });
})(jQuery);