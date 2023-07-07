$(document).ready(function (e) {
    $('.splide').each(function(){
        var splide = $(this).attr('id');
        new Splide( '.' + splide, {
            classes: {
                arrows: 'splide__arrows',
                arrow : 'splide__arrow',
                prev  : 'splide__arrow--prev',
                next  : 'splide__arrow--next',
            },
            type   : 'loop',
            perPage: 3,
            perMove: 1,
            autoplay: true,
        } ).mount();
    });

    // Custom Scroll
    if (!$.browser.webkit) {
        $('#scrollWrapper').html('<p>Sorry! Non webkit users. :(</p>');
    }

});


function aos_init() {
    AOS.init({
        duration: 500,
        easing: 'ease-in-out',
        once: true,
        mirror: false
    });
}

window.addEventListener('load', () => {
    aos_init();
});


$('.category').mouseenter(function(e){
    $(this).addClass('show');
    $(this).find('.c-d-menu').first().addClass('show');
});

$('.category').mouseleave(function(e){
    $(this).removeClass('show');
    $(this).find('.c-d-menu').first().removeClass('show');
});


$('.scrollbar').each(function () {
    var search = 'search_' + $(this).attr('content');
    var scroll = $(this).attr('content') + 'Scroll';

    $('#' + search).keyup(function(){

        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val();
        // Loop through the comment list
        $("div.scrollbar#" + scroll + " div#filterContent").each(function(){


            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();

                // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).show();
            }
        });

    });
});

var sortOrder = $('div#sortOrder');

if (sortOrder.onclick) {
    sortOrder.mouseenter(function () {
        $(this).addClass('product_link_is_active');
    }).on('click', function () {
        $(this).addClass('product_link_is_active');
    })
} else {
    sortOrder.mouseenter(function () {
        $(this).addClass('product_link_is_active');
    }).mouseleave(function () {
        $(this).removeClass('product_link_is_active');
    }).on('click', function () {
        $(this).addClass('product_link_is_active');
    })
}

$('input[type=radio][name=ordering]').on('click', function () {
    var html = '<input type="hidden" name="ordering" value="'+ $(this).attr('content') +'">';
    $('form#productFilter').append(html);
});
