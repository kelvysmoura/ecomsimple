"use_strict";
$(document).ready(function(){
    const ukalert = $('.uk-alert');
    ukalert.hide();
    ukalert.click(function(){
        $(this).fadeOut('fast');
    });   
});