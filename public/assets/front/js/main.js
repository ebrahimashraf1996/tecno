
$(document).ready(function(){
    $("a").on('click', function(event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){
                window.location.hash = hash;
            });
        }
    });

    $(".service_more").slideUp(10);




});

(function($) {
    "use strict";
    /*start of home slider*/
    $("#home-slider").owlCarousel({
        items: 1,
        nav: false,
        dots: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        autoplay: true,
        loop: true,
        mouseDrag: false,
        touchDrag: false,
        smartSpeed: 600
    });

    $("#home-slider").on("translate.owl.carousel", function() {
        $(".single-slide-item h2, .single-slide-item p").removeClass("animated fadeInUp").css("opacity", "0");
        $(".single-slide-item .digest-btn").removeClass("animated fadeInDown").css("opacity", "0");
        $(".single-slide-item img").removeClass("animated fadeIn").css("opacity", "0");
    });

    $("#home-slider").on("translated.owl.carousel", function() {
        $(".single-slide-item h2, .single-slide-item p").addClass("animated fadeInUp").css("opacity", "1");
        $(".single-slide-item .digest-btn").addClass("animated fadeInDown").css("opacity", "1");
        $(".single-slide-item img").addClass("animated fadeIn").css("opacity", "1");
    });
    /*end of home slider*/
    new WOW().init();

    $(window).on('load', function() {
        $("#home-slider .owl-controls").addClass("container");
    });

    $('.owl-prev').text('');
    $('.owl-next').text('');

}(jQuery));
$(document).ready(function(){

    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });



});


//Counter

$(window).ready(function() {
    $('.counter').counterUp({
        delay: 5,
        time:2000
    });
});
