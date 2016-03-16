/**
 * Created by daitd on 3/2/2016.
 */
$(document).ready(function() {
    'use strict';
    $("#auto").autocomplete({
        source: "autocomplete",
        minLength: 1,
        //select: function(event, ui) {
        //    var url = ui.item.value;
        //    if(url != '#') {
        //        location.href = 'result';
        //    }
        //},

        html: true, // optional (jquery.ui.autocomplete.html.js required)

        // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            $(".ui-autocomplete").css("z-index", 1000);
        }
    });

});