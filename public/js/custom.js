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
