(function (e) {
    "use strict";
    var n = window.TWP_JS || {};
    n.stickyMenu = function () {
        e(window).scrollTop() > 350 ? e("body").addClass("nav-affix") : e("body").removeClass("nav-affix")
    },
        n.mobileMenu = {
            init: function () {
                 this.menuMobile(), this.toggleIcon(), this.menuDesktoparrow(), this.menuMobilearrow()
            },

            menuMobile: function () {
                e('.offcanvas-toggle, .offcanvas-close').on('click', function(event) {
                    e('body').toggleClass('offcanvas-menu-open');
                });
                jQuery( 'body' ).append( '<div class="offcanvas-overlay"></div>' );
            },

            toggleIcon: function () {
                e('#offcanvas-menu .offcanvas-navigation').on('click', 'li a i', function(event) {
                    event.preventDefault();
                    var ethis = e(this),
                        eparent = ethis.closest('li'),
                        esub_menu = eparent.find('> .sub-menu');
                    if (esub_menu.css('display') == 'none') {
                        esub_menu.slideDown('300');
                        ethis.addClass('active');
                    } else {
                        esub_menu.slideUp('300');
                        ethis.removeClass('active');
                    }
                    return false;
                });
            },

            menuDesktoparrow: function () {
                if (e('#masthead .main-navigation div.menu > ul').length) {
                    e('#masthead .main-navigation div.menu > ul .sub-menu').parent('li').find('> a').append('<i class="ion-ios-arrow-down">');
                }
            },

            menuMobilearrow: function () {
                if (e('#offcanvas-menu .offcanvas-navigation div.menu > ul').length) {
                    e('#offcanvas-menu .offcanvas-navigation div.menu > ul .sub-menu').parent('li').find('> a').append('<i class="ion-ios-arrow-down">');
                }
            }
        },

        n.TwpReveal = function () {
            e('.icon-search').on('click', function(event) {
                e('body').toggleClass('reveal-search');
            });
            e('.close-popup').on('click', function(event) {
                e('body').removeClass('reveal-search');
            });
        },

        /*Widgets Navigation*/
        n.TwpWidgetsNav = function () {
            e('#widgets-nav').sidr({
                name: 'sidr-nav',
                side: 'right'
            });

            e('.sidr-offcanvas-close').click(function () {
                e.sidr('close', 'sidr-nav');
            });
        },

        n.DataBackground = function () {
            e('.bg-image').each(function () {
                var src = e(this).children('img').attr('src');
                e(this).css('background-image', 'url(' + src + ')').children('img').hide();
            });
        },

        n.InnerBanner = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {
                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });
        },

        n.TwpSlider = function () {
            e(".twp-slider-main").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                dots: false,
                arrows: true,
                prevArrow: e('.slide-prev-1'),
                nextArrow: e('.slide-next-1'),
                speed: 500,
                centerMode: false,
                draggable: true,
                touchThreshold: 20,
                cssEase: 'cubic-bezier(0.28, 0.12, 0.22, 1)'
            });

            e(".twp-slider-secondary").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                dots: false,
                arrows: false,
                asNavFor: '.slider-nav'
            });


            e('.slider-nav').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.twp-slider-secondary',
                dots: false,
                arrows: false,
                focusOnSelect: true,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            e(".gallery-columns-1, .wp-block-gallery.columns-1").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                arrows: false,
                nextArrow: '<i class="navcontrol-icon slide-next ion-ios-arrow-right"></i>',
                prevArrow: '<i class="navcontrol-icon slide-prev ion-ios-arrow-left"></i>',
                dots: false
            });

            e(".recent-slider").each(function () {
                e(this).slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    dots: false,
                    infinite: false,
                    prevArrow: e('.slide-prev-2'),
                    nextArrow: e('.slide-next-2'),
                    responsive: [
                        {
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            });

            e(".recommendation-slides").each(function () {
                e(this).slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    dots: false,
                    infinite: false,
                    nextArrow: '<i class="navcontrol-icon navcontrol-icon-small slide-next ion-ios-arrow-right"></i>',
                    prevArrow: '<i class="navcontrol-icon navcontrol-icon-small slide-prev ion-ios-arrow-left"></i>',
                    responsive: [
                        {
                            breakpoint: 1199,
                            settings: {
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            });
        },

        n.MagnificPopup = function () {
            e('.zoom-gallery, .widget .gallery, .entry-content .gallery, .wp-block-gallery').each(function () {
                e(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    closeOnContentClick: false,
                    closeBtnInside: false,
                    mainClass: 'mfp-with-zoom mfp-img-mobile',
                    image: {
                        verticalFit: true,
                        titleSrc: function (item) {
                            return item.el.attr('title');
                        }
                    },
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function (element) {
                            return element.find('img');
                        }
                    }
                });
            });
        },

        n.fixed_drawer_scroll = function () {
            if (e(window).scrollTop() > e(window).height() / 2) {
                e("#recommendation-panel-content").fadeIn(300).css({'opacity': 1});
            } else {
                e("#recommendation-panel-content").fadeOut(300).css({'opacity': 0});
            }
        },

        n.fixed_drawer = function () {
            e('#recommendation-panel-content').each(function(){
                var post_bar = e(this);
                var post_button = e(this).siblings('#recommendation-panel-handle');

                if( post_bar.css('display') != 'none' ){
                    e('html').css({'padding-bottom': 75});
                }

                e(this).on('click', '.recommendation-panel-close', function(){
                    post_bar.slideUp(200, function(){
                        post_button.addClass('rec-panel-active');
                    });
                    e('html').animate({'padding-bottom':0}, 200);
                    e('html').addClass('recommendation-panel-disabled');
                });

                post_button.on('click', function(){
                    post_button.removeClass('rec-panel-active');
                    post_bar.slideDown(200);
                    e('html').animate({'padding-bottom': 75}, 200);
                    e('html').removeClass('recommendation-panel-disabled');
                });
            })
        },

        // SHOW/HIDE SCROLL UP //
        n.show_hide_scroll_top = function () {
            if (e(window).scrollTop() > e(window).height() / 2) {
                e(".scroll-up").fadeIn(300);
            } else {
                e(".scroll-up").fadeOut(300);
            }
        },

        // SCROLL UP //
        n.scroll_up = function () {
            e(".scroll-up").on("click", function () {
                e("html, body").animate({
                    scrollTop: 0
                }, 700);
                return false;
            });
        },

        n.twp_preloader = function () {
            e(window).load(function(){
                e("body").addClass("page-loaded");
            });
        },

        n.twp_matchheight = function () {
            jQuery('.theiaStickySidebar', 'body').parent().theiaStickySidebar({
                // Settings
                additionalMarginTop: 30
            });
        },

        e(document).ready(function () {
            n.mobileMenu.init(), n.TwpReveal(), n.TwpWidgetsNav(), n.DataBackground(), n.InnerBanner(), n.TwpSlider(), n.scroll_up(), n.twp_preloader(), n.fixed_drawer(), n.MagnificPopup(), n.twp_matchheight();
        }), e(window).scroll(function () {
        n.stickyMenu(), n.fixed_drawer_scroll(), n.show_hide_scroll_top();
    })
})(jQuery);