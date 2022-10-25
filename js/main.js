(function($) {

    "use strict" ; 

    
    /* A function that is called when the user scrolls the page. It changes the height of the navbar
    and the page-hero. */
    $(window).on('scroll', () => {

        if($(window).scrollTop() >= 170) 
            {
            $(".navbar").css("background-color", "rgba(0, 0, 0, 0.8)") ;
            $(".navbar").css("height", "120px") ;
            $(".navbar .logo img").css("height", "120px") ;
            $(".page-hero").css("transition", "height .4s ease-out") ;
            $(".page-hero").css("height", "500px") ;
            $("#homepage-hero ").css("height", "calc( 100vh - 120px )") ;
            }

        if($(window).scrollTop() <= 120) 
            {
            $(".navbar").css("background-color", "rgba(0, 0, 0, 0)") ;
            $(".navbar").css("height", "170px") ;
            $(".navbar .logo img").css("height", "170px") ;
            $(".page-hero").css("transition", "height .4s ease-out") ;
            $(".page-hero").css("height", "450px") ;
            $("#homepage-hero ").css("height", "calc( 100vh - 170px )") ;
            }
        }) ;


    function make_nav_link_active($url)
        {
        /**
        * It adds the class "active" to the nav-link that corresponds to the current page
        * 
        * @param  The URL of the page you want to make active.
        */

        const btnContainer = document.getElementById("navbarSupportedContent") ; 
        const link = btnContainer.getElementsByClassName("nav-link") ;
        const page = window.location.href ;
  
        for (let i = 0; i < link.length; i++) 
            {
            if( !$(link[i]).hasClass("active") ) 
                {
                $("a[href='" + page + "']").addClass("active") ;
                }

            link[i].addEventListener("click", function() 
                {
                var current = document.getElementsByClassName("active") ;
                current[0].className = current[0].className.replace(" active", "") ;
                this.className += " active" ;
                }) ;
            }
        }


    $(document).ready(function() 
        {
        make_nav_link_active();

        /* A jQuery function that is used to create a carousel. */
        $('#logo-carousel .owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:false,
            responsive:{
                0:{
                    items:1
                    },
                800:{
                    items:2
                    },
                1200:{
                    items:3
                    },
                }
            }) ;

        lightGallery(document.getElementById("gallery-container"), {
            speed: 400,
            thumbnail: true,
            fullScreen: true,
            animateThumb: false,
            zoomFromOrigin: false,
            allowMediaOverlap: true,
            toggleThumb: true,
            slideShowInterval:100,
            speed:0,
            plugins: [lgZoom, lgThumbnail, lgFullscreen, lgAutoplay],
            }) ;

        lightGallery(document.getElementById("gallery-container-tris"), {
            speed: 400,
            thumbnail: true,
            fullScreen: true,
            animateThumb: false,
            zoomFromOrigin: false,
            allowMediaOverlap: true,
            toggleThumb: true,
            slideShowInterval:100,
            speed:0,
            plugins: [lgZoom, lgThumbnail, lgFullscreen, lgAutoplay],
            }) ;
            
        lightGallery(document.getElementById("gallery-container-bis"), {
            speed: 400,
            thumbnail: true,
            fullScreen: true,
            animateThumb: false,
            zoomFromOrigin: false,
            allowMediaOverlap: true,
            toggleThumb: true,
            slideShowInterval:100,
            speed:0,
            plugins: [lgZoom, lgThumbnail, lgFullscreen, lgAutoplay],
            }) ;

    /* A jQuery function that is used to create a carousel. */
    $('#travel-highlights.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:false,
        responsive:{
            0:
                {
                items:1,
                },
            576:
                {
                items:1,
                stagePadding: 50,
                },
            1140:
                {
                items:2,  
                stagePadding: 50,   
                },
            2000:
                {
                items:3,  
                stagePadding: 50,   
                }
            }
        }) ;


    /* A jQuery function that is used to create a carousel. */
    $('#departing-trips.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:false,
        responsive:{
            0:
                {
                items:1,
                },
            576:
                {
                items:1,
                stagePadding: 50,
                },
            1140:
                {
                items:2,  
                stagePadding: 50,   
                },
            2000:
                {
                items:3,  
                stagePadding: 50,   
                }
            }
        }) ;
        
    /* A jQuery function that is used to create a carousel. */
    $('#choosing-us .owl-carousel').owlCarousel({
        margin:10,
        responsiveClass:false,
        center: true,
        loop: $('#choosing-us .owl-carousel').children().length > 2,
        responsive:{
            0:{
                items:1
                },
            800:{
                stagePadding: 50,   
                items:2
                },
            1200:{
                stagePadding: 50,   
                items:3
                },
            }
        }) ;


    /* A jQuery function that is used to toggle the short and long content of the single-info page. */
    $("#single-info #content #expand-content").on('click', () => {
        $( "#single-info #content .short" ).toggle();
        $( "#single-info #content .long" ).toggle();        
        }) ;


    /* The above code is a jQuery AJAX call to a PHP script. */
    $("#value").on("click", () => {
        if( $("#txt").val().trim != "" ) 
            {
            $("#search").submit() ;
            }
        }) ;

        
    $("#more-content-down").on("click", function()
        {
        $("#zzz").html( $("#content-long").val() ) ;
        $("#more-content-down").css("display", "none") ;
        $("#more-content-up").css("display", "block") ;
        }) ;

        
    $("#more-content-up").on("click", function()
        {
        $("#zzz").html( $("#content-short").val() ) ;
        $("#more-content-down").css("display", "block") ;
        $("#more-content-up").css("display", "none") ;
        }) ;


    $(".dbd-down").on("click", function()
        {
        $(this).parent().find(".dbd-content-long").css("display", "block") ;
        $(this).parent().find(".dbd-content-short").css("display", "none") ;
        $(this).css("display", "none") ;
        $(this).parent().find(".dbd-up").css("display", "block") ;
        }) ;


    $(".dbd-up").on("click", function()
        {
        $(this).parent().find(".dbd-content-short").css("display", "block") ;
        $(this).parent().find(".dbd-content-long").css("display", "none") ;
        $(this).css("display", "none") ;
        $(this).parent().find(".dbd-down").css("display", "block") ;
        }) ;

    }) ;
     
})(jQuery) ; 
