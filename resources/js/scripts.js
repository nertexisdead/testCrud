$(document).ready(function () {
    $('body')
        .off('submit.new_post_form')
        .on('submit.new_post_form', 'form.new_post_form', function (e) {
            window.defaultFormPostHandler(this, e);
        })

        .off('submit.edit_post_form')
        .on('submit.edit_post_form', 'form.edit_post_form', function (e) {
            window.defaultFormPostHandler(this, e);
        })
    ;
});
