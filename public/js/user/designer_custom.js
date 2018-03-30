$('.nav-tabs').scrollingTabs();

$(document).ready(function () {
    $("#profile-detail").owlCarousel({
        navigation: true,
        navigationText: ['‹', '›'],
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        afterInit: makePages,
        afterUpdate: makePages,

    });

    function makePages() {
        $.each(this.owl.userItems, function (i) {
            $('.owl-controls .owl-page').eq(i)
                .css({
                    'background': 'url(' + $(this).find('img').attr('src') + ')',
                    'background-size': 'cover',
                    'margin': '0 5px'
                })
        });
    }

    var owl = $('.owl-carousel.grid');
    owl.owlCarousel({
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 20,
        nav: true,
        dots: true,
        loop: true,
        responsive: {
            0: {
                items: 1
            },

            599: {
                items: 1
            },
            600: {
                items: 1
            },

            767: {
                items: 1
            },
            768: {
                items: 3
            },
            991: {
                items: 3
            },
            992: {
                items: 4
            },

            1200: {
                items: 4
            }
        }
    })

    var owl = $('#service-carousel.owl-carousel');
    owl.owlCarousel({
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 15,
        nav: true,
        loop: false,
        responsive: {
            0: {
                items: 3
            },
            600: {
                items: 3
            },
            991: {
                items: 3
            },
            992: {
                items: 5
            }
        }
    })


    $('.selectpicker').selectpicker('refresh');

    var owl = $('#blog-carousel .owl-carousel');
    owl.owlCarousel({
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 30,
        nav: true,
        loop: false,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            991: {
                items: 3
            },
            992: {
                items: 3
            }
        }
    })

}); //End-Ready-Function


// ===== Scroll to Top ==== 
$(window).scroll(function () {
    if ($(this).scrollTop() >= 50) { // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200); // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200); // Else fade out the arrow
    }
});
$('#return-to-top').click(function () { // When arrow is clicked
    $('body,html').animate({
        scrollTop: 0 // Scroll to top of body
    }, 3000);
});

// Search Box 
jQuery(".search-btn").click(function () {
    jQuery(".search-btn").removeClass("active");
    jQuery(".search-field").addClass("active");
    jQuery(".search-close-btn").addClass("active");
});
jQuery(".search-close-btn").click(function () {
    jQuery(".search-btn").addClass("active");
    jQuery(".search-close-btn").removeClass("active");
    jQuery(".search-field").removeClass("active");
});

/********************************************************************************************************************************/
/********************************************************************************************************************************/
/********************************************************************************************************************************/
// sticky header js 
jQuery(document).ready(function () {
    jQuery('p.comment-form-comment label').html('Comment <span class="required">*</span>');
    //jQuery('p.comment-form-comment label').text('Comment <span class="required">*</span>');
});
jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 1) {
        jQuery('header.dr-header').addClass("sticky");
    } else {
        jQuery('header.dr-header').removeClass("sticky");
    }
});

$('#carousel-example-generic').carousel({
    interval: 6000
});