let isModifyActive = false;

$(".button-box-container").click(function() {
    let buttonBox = $(this).find('.button-box');
    let link = buttonBox.data("button-link");
    let isNew = buttonBox.data("button-is-new");

    if (isModifyActive == false) {
        if (isNew == '1') {
            window.open(link, '_self');
        } else {
            window.open(link, '_blank');
        }
    }
});

$(".button-box-container").mouseover(function() {
    if (isModifyActive == false) {
        $(this).find('.button-overlay-info').css('display', 'flex');
        $(this).find('.button-title-box').show();
    }
});

$(".button-box-container").mouseout(function() {
    if (isModifyActive == false) {
        $(this).find('.button-overlay-info').hide();
        $(this).find('.button-title-box').hide();
    }
});


$(".modify-data-btn").click(function() {
    isModifyActive = true;

    $(this).hide();
    $('.close-modifier-btn').show();

    $('.button-box-container').each(function(i, obj) {
        $(this).find('.button-overlay-info').css('display', 'flex');
        $(this).find('.button-data-options').show();
    });
});

$(".close-modifier-btn").click(function() {
    isModifyActive = false;

    $(this).hide();
    $('.modify-data-btn').show();

    $('.button-box-container').each(function(i, obj) {
        $(this).find('.button-overlay-info').css('display', 'none');
        $(this).find('.button-data-options').hide();
    });
});