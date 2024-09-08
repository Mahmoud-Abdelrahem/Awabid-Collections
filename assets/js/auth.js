(function () {

    "use strict";
    
    // typed js
    var typed = new Typed('#element', {
        strings: ['Welcome again to our stock !', 'We are happy to join us again', 'Enjoy my Friend ..'],
        typeSpeed: 50,
        loop: true,
        loopCount: Infinity,
    });


    $(document).ready(function () {
        $("#preloader").on(500).fadeOut();
        $(".preloader").on(600).fadeOut("slow");
    })
})()