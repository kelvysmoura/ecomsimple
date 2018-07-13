const product = $('#product');
const pModal = $('#product_modal');
const icon_spiner = '<div class="uk-text-center"><span class="uk-margin-small" uk-spinner="ratio: 2"></span></div>';

$('#frete_info').on('click', 'label', function (e) {
    const that = $(this);
    that.siblings().removeClass('uk-active');
    that.addClass('uk-active');
    $('#buy').removeAttr('disabled');
    pModal.find('input[name="frete_type"]').val(that.attr('data-frete-type'));
    pModal.find('input[name="frete_price"]').val(that.attr('data-frete-price'));
    pModal.find('input[name="frete_time"]').val(that.attr('data-frete-time'));
});

product.find('form#calc_frete').validate({
    errorClass: 'uk-form-danger',
    rules: {
        frete: {
            required: true
        }
    },
    messages: {
        frete: {
            required: "Digite seu cep"
        }
    }
});

product.find('form#finish_buy').validate({
    errorClass: 'uk-form-danger',
    rules: {
        product_price: "required",
        cli_name: {
            required: true,
            minlength: 3
        },
        cli_email: {
            required: true,
            email: true
        }
    },
    messages: {
        cli_name:{
            required: "Campo obrigatorio",
            minlength: "Campo precisa de no minimo 3 caracteres"
        },
        cli_email: {
            required: "Campo obrigatorio",
            email: "Informe um email valido"
        }
    }
});

product.find('form#calc_frete').submit(function (e) {
        e.preventDefault();
        const that = $(this);
        const destino = that.find('input[name="frete"]').val().replace('-', '');
        const frete_info = $('#frete_info');
        $('#buy').attr('disabled', true);
        if (that.valid()) {
            that.find('input[type="submit"]').val('Calculando...').attr('disabled', true);
            frete_info.html(icon_spiner);
            const product_price = product.find('[data-product-price]').attr('data-product-price');
            $(this).esAjax({
                uri: '/'+destino,
                data: new FormData(this),
                processData: false,
                contentType: false
            }, function (res) {
                let bntFrete = '';
                $.each(res.data, function(k, v){
                    bntFrete += `<label class="uk-button uk-button-default uk-button-small" data-frete-type="${v.ServicoName}" data-frete-price="${v.Valor}" data-frete-time="${v.PrazoEntrega}">
                    ${v.ServicoName} - R$ ${v.Valor} <br> ${v.PrazoEntrega} dias úteis</label>`;
                });
                frete_info.html(bntFrete);
                that.find('input[type="submit"]').val('Calcular frete').removeAttr('disabled');
            });
        }
        else{
            frete_info.html('');
        }
});

product.find('form#finish_buy').submit(function (e) {
    e.preventDefault();
    const that = $(this);
    if (that.valid()) {
        pModal.find('.uk-modal-body').html(icon_spiner);
        $(this).esAjax({
            data: new FormData(this),
            processData: false,
            contentType: false
        }, function (res) {
                pModal.find('.uk-modal-body').html("<h4 class='uk-text-center'>" + res.data + "</h4>");
        });
    }
});