$('.edit-input-title').change(function() {
    let title = $(this).val();
    $('.edit-button-preview-box').find('.button-title-box').html(title);
    $('.edit-button-preview-box').find('.button-box').attr('data-button-title', title);
});

$('.edit-input-link').change(function() {
    let link = $(this).val();
    $('.edit-button-preview-box').find('.button-box').attr('data-button-link', link);
});

$('.edit-input-color').change(function() {
    let color = $(this).val();
    $('.edit-button-preview-box').find('.button-box').css('color', color);
    $('.edit-button-preview-box').find('.button-box').attr('data-button-color', color);
});