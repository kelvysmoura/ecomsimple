(function ($) {
    $.fn.esAjax = function(opts, callback){
        const that = $(this);
        
        const ajxObj = {
            method: that.attr('method'),
            url: that.attr('action'),
            uri: '',
            data: {
                data_serialize: that.serialize()
            },
            cache: false
        }
        
        const sttg = $.extend({}, ajxObj, opts);
        
        if(that.attr('enctype') !== undefined){
            sttg.data = new FormData(that[0]);
            sttg.processData = false;
            sttg.contentType = false;
        }

        sttg.url += sttg.uri;
        const request = $.ajax(sttg);
        
        request.done(function(res, msg, xhr){
            return callback(res, msg, xhr);
        });

        request.fail(function(xhr){
            return callback(xhr.responseJSON);
        });
    }
})(jQuery);