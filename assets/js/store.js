const card_img = $('.open-img-modal');
const modal_img = $('#modal-img');
card_img.click(function(){
    const pid = $(this).attr('data-product-id');
    const url = modal_img.attr('data-product-url');
    modal_img.find('a').attr('href', url+pid);
    modal_img.find('img').attr('data-src', $(this).find('img').attr('data-src'));
    console.log(url);
});