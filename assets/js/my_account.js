const account = $('#my_account');

account.find('form').validate({
    errorClass: 'uk-form-danger',
    rules: {
        first_name: {
            required: true,
            minlength: 3
        },
        last_name: {
            required: true,
            minlength: 3
        },
        email: {
            required: true,
            email: true
        }
    },
    messages: {
        first_name: {
            required: "Campo Nome deve ser preenchido",
            minlength: "Campo Nome deve ter no minimo 3 caracteres"
        },
        last_name: {
            required: "Campo Sobrenome deve ser preenchido",
            minlength: "Campo Sobrenome deve ter no minimo 3 caracteres"
        },
        email: {
            required: "Campo Eamil deve ser preenchido",
            email: "Infome um email válido"
        }
    }
});

account.find('form').submit(function (e) {
        e.preventDefault();
        const that = $(this);
        const alert = that.siblings('.uk-alert');
        alert.fadeOut('fast');
        if (that.valid()) {
            that.esAjax({
                data: new FormData(this),
                processData: false,
                contentType: false
            }, function (res) {
                console.log(res);
               if(true === res.error){
                   alert.removeClass('uk-alert-primary').addClass('uk-alert-danger').html(res.data).fadeIn();
                }
                else{
                   alert.removeClass('uk-alert-danger').addClass('uk-alert-primary').html(res.data).fadeIn();
                }
            });
        }
});