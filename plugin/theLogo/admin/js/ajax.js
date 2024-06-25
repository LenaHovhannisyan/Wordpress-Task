jQuery(document).ready(function ($) {
    let page = 1;

    $('#thelogo-load-more').on('click', function () {
        page++;
        let data = {
            'action': 'thelogo_load_more_books',
            'page': page
        };

        $.post(thelogo_ajax_obj.ajaxurl, data, function (response) {
            if (response.success) {
                $('#thelogo-book-list').append(response.data);
                console.log(page)
            } else {
                console.log(response.data);

                if ($("#thelogo-book-list").hasClass("loaded-all")) {
                    $("#thelogo-book-list").removeClass("loaded-all");
                } else {
                    $("#thelogo-book-list").addClass("loaded-all");
                }
            }
        }).fail(function (xhr, status, error) {
            console.log(xhr);
        });
    });
});
