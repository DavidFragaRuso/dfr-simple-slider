( function( $ ) {

    function calcAspectRatio() {
        if ($(".swiper").length) {
            var sliderWidth = $('.swiper').width();
            var sliderHeight = $('.swiper').height();
            $(".swiper-slide > img").css({
                "width": sliderWidth,
                "height": sliderHeight
            })  
        }
    }

    $(document).ready( function() {

        calcAspectRatio();

        $(window).resize(function() {
            calcAspectRatio();    
        });  

        var swiper = new Swiper(".swiper", {
            lazy: true,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    } );
}( jQuery ) );
