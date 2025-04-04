import './bootstrap';

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'admin-lte';

import toastr from 'toastr/toastr';
window.toastr = toastr;

window.defaultErrorHandler = function ($context, requestData) {
    const data = requestData.response.data;
    const errors = data.errors;
    if (errors) {
        for (let field in errors) {
            $context.find('span.error.' + field).text(errors[field]);
            $context.find('span.error[data-name="' + field + '"]').text(errors[field]);
            $context.find('[name="' + field + '"]').addClass('is-invalid');
        }
    }
    $context.find('button[type=submit]').removeAttr('disabled');
    data.message = ((typeof data.message !== 'undefined')
            ? data.message
            : 'Проверьте правильность заполнения формы'
    );
    toastr.error(data.message);
};

window.defaultFormPostHandler = function (form, e) {
    let $context = $(form);
    $context
        .find('input,select,textarea')
        .removeClass('is-invalid')
    ;
    $context.find('span.error').html('');
    e.preventDefault();

    const formData = new FormData(form);

    axios
        .post(
            $context.attr('data-action'),
            formData
        )
        .then(window.defaultSuccessHandler)
        .catch((responseData) => window.defaultErrorHandler($context, responseData))
    ;
};

window.defaultSuccessHandler = function (response) {
    if (typeof response.data.message !== 'undefined') {
        toastr.success(response.data.message);
    }
    if (typeof response.data.redirect !== 'undefined') {
        window.location.href = response.data.redirect;
    }
    if (typeof response.data.reload !== 'undefined') {
        window.location.reload();
    }
};

window.onload = function () {
    $('body')
        .off('submit.delete_entity')
        .on('submit.delete_entity', 'form.delete_entity', function (e) {
            const $context = $(this);
            e.preventDefault();

            if (window.confirm("Вы уверены что хотите удалить?")) {
                axios
                    .delete(
                        $context.attr('data-action')
                    )
                    .then(window.defaultSuccessHandler)
                    .catch((responseData) => window.defaultErrorHandler($context, responseData))
                ;
            }
        })

    $(document).ready(function () {
        $('.toggle_entity_activity').on('change', function () {
            const $context = $(this);

            axios
                .put(
                    $context.attr('data-action')
                )
                .then(window.defaultSuccessHandler)
                .catch((responseData) => window.defaultErrorHandler($context, responseData))
            ;
        })
    })
}
