/**
 * Created by daitd on 3/2/2016.
 */
$(function() {

    $("#topic_title").autocomplete({
        source: "http://localhost/tra-cuu-diem-thi/resources/views/search.blade.php",
        minLength: 2,
        select: function(event, ui) {
            var url = ui.item.id;
            if(url != '#') {
                location.href = '/blog/' + url;
            }
        },

        html: true, // optional (jquery.ui.autocomplete.html.js required)

        // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            $(".ui-autocomplete").css("z-index", 1000);
        }
    });

});