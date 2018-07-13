const promotion = $('#new_promotion');

promotion.find('input[name="price"]').on('blur', function () {
    const elem = promotion.find('.es-preview span').get(-1);
    $(elem).html("Por R$ " + $(this).val());
});

promotion.find('form select').change(function () {
    const selected = $(this).find(':selected');
    const preview = `
        <span>${selected.text()}</span> | 
        <span>De R$ ${selected.attr('data-price')}</span> - 
        <span>Por R$ ${promotion.find('input[name="price"]').val()}</span>
    `;
    if ($(this).val() === "") {
        promotion.find('.es-preview').html('');
    }
    else {
        promotion.find('#price_current').val(selected.attr('data-price'));
        promotion.find('.es-preview').html(preview);
    }
});

promotion.find('form').validate({
    errorClass: 'uk-form-danger',
    rules: {
        product: "required",
        date_start: "required", 
        hour_start: "required",
        date_end: "required",
        hour_end: "required",
        price: "required"
    },
    messages: {
        product: "Escolha um produto",
        date_start: "Defina a data de inicio dessa promoção",
        hour_start: "Defina a hora de inicio dessa promoção",
        date_end: "Defina a data de fim dessa promoção",
        hour_end: "Defina a hora de fim dessa promoção",
        price: "Defina o valor do produto durante essa promoção"
    }
});

promotion.find('form').submit(function (e) {
        e.preventDefault();
        const that = $(this);
        const alert = that.siblings('.uk-alert')
        alert.fadeOut('fast');
        if (that.valid()) {
            that.esAjax({
                data: new FormData(this),
                processData: false,
                contentType: false
            }, function (res) {
                if (true === res.error) {
                    alert.html(res.data)
                        .addClass('uk-alert-danger')
                        .removeClass('uk-alert-primary')
                        .fadeIn();
                }
                else {
                    promotion.find('.es-preview').html('');
                    that[0].reset();
                    alert.html(res.data)
                        .removeClass('uk-alert-danger')
                        .addClass('uk-alert-primary')
                        .fadeIn();
                }
            });
        }
});
