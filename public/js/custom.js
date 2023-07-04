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

$('.collapse-down').on('click', function () {
    $(this).find('span.bi-chevron-down').first().css({'transform': 'rotate(-180deg)'});
});
