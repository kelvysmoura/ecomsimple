const view_product = $('#view_product');

view_product.find('table button').click(function(){
    const that = $(this);
    const this_html = that.html();
    that.attr('disabled', true);
    that.html('<span class="uk-margin-small" uk-spinner="ratio: 0.6">');

    that.esAjax({
        method: 'DELETE',
        url: that.attr('data-action')
    }, function (res) {
        if(false === res.error){
            console.log(res);
            UIkit.notification({
                message: res.data,
                status: 'primary',
                pos: 'top-lef',
                timeout: 1500
            });
            that.parent().parent().remove();
        }
        else{
            UIkit.notification({
                message: res.data,
                status: 'danger',
                pos: 'top-lef',
                timeout: 1500
            });
            that.attr('disabled', false).html(this_html);
        }
    });
});