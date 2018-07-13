const newProduct = $('#new_product');

newProduct.find('form input[type="file"]').change(function () {
    const that = $(this);
    let filename = $(that.val().split('\\')).get(-1);
    that.siblings('label').children('span').html(filename);
});

newProduct.find('form').validate({
    errorClass: 'uk-form-danger',
    rules: {
        name: "required",
        price: "required",
        description: "required",
        img: "required"
    },
    messages: {
        name: "Crie um nome para seu produto",
        price: "Defina um valor para seu produto",
        description: "Defina uma breve descrição do seu produto",
        img: "Escolha uma imagem para aseu produto"
    }
});

newProduct.find('form').submit(function (e) {
        e.preventDefault();
        const that = $(this);
        const alert = that.siblings('.uk-alert')
        alert.fadeOut('fast');
        if (that.valid()) {
            that.esAjax({}, function (res) {
                if (true === res.error) {
                    alert.html(res.data)
                        .addClass('uk-alert-danger')
                        .removeClass('uk-alert-primary')
                        .fadeIn();
                }
                else {
                    that.find('input[type="file"]').siblings('label').children('span').html('');
                    that[0].reset();
                    alert.html(res.data)
                        .removeClass('uk-alert-danger')
                        .addClass('uk-alert-primary')
                        .fadeIn();
                }
            });
        }
});