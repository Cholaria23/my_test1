require('./../../bootstrap');

import Vue from 'vue';
import PerfectScrollbar from 'perfect-scrollbar';
import AOS from 'aos';
import anime from 'animejs';

window.Slick = require('slick-carousel');
window.Sticky = require('sticky-kit/dist/sticky-kit.js');
window.Magnific = require('magnific-popup');
window.Vue = require('vue');
window.VueGoogleMap = require('vue2-google-maps');

// Components
Vue.component('subscribe-form', require('./components/subscribeForm.vue'));
Vue.component('marketing-support-form', require('./components/marketingSupportForm.vue'));
Vue.component('workplace-form', require('./components/workplaceForm.vue'));
Vue.component('request-form', require('./components/requestForm.vue'));
Vue.component('main-slider', require('./components/mainSlider.vue'));
Vue.component('contacts-map', require('./components/map.vue'));
Vue.component('person-slider', require('./components/personSlider.vue'));
Vue.component('add-review-form', require('./components/addReviewForm.vue'));
Vue.component('files', require('./components/files.vue'));

Vue.prototype.trans = string => _.get(window.langObj, string);

const front = new Vue({
    el: '#wrapper',
    data: {
        item: null
    }
});

// ----- //
// Custom
// ----- //
AOS.init();

window.onload = function () {

    // Animation
    let item = document.getElementById('pProduct__lineBig');
    if (item) {
        setTimeout(function () {
            item.classList.remove('hide');
        }, 1000)
    }

    // Start switcher
    let langSwitcher = document.querySelector('.langSwitcher');
    let mSidebar__switcher = document.querySelector('.mSidebar__switcher');
    let langSwitcher__close = document.querySelector('.langSwitcher__close');
    let pStart = document.querySelector('.pStart');
    // if (langSwitcher) {
    //     langSwitcher.onclick = function () {
    //         pStart.style.display = 'block';
    //     }
    // }
    if (mSidebar__switcher) {
        mSidebar__switcher.onclick = function () {
            pStart.style.display = 'block';
        }
    }
    if (langSwitcher__close) {
        langSwitcher__close.onclick = function () {
            pStart.style.display = 'none';
        }
    }
    let pStart__form = document.querySelector('.pStart__form');
    if (pStart__form) {
        pStart__form.onsubmit = function (e) {
            e.preventDefault();
            let csrf = document.getElementById('meta-csrf-token').getAttribute('content');

            let form_data = new FormData();

            let country_select = document.getElementById('country_select');
            if (country_select) {
                let country_id = country_select.options[country_select.selectedIndex].getAttribute('value');
                form_data.append('country_id', country_id);
            }

            let language_select = document.getElementById('language_select');
            if (language_select) {
                let language_id = language_select.options[language_select.selectedIndex].getAttribute('value');
                form_data.append('language_id', language_id);
            }
            axios.post('/select-country-and-language', form_data)
                .then((response) => {
                    if (response.data.answer) {
                        // let url = response.data.url ? response.data.url : window.location.href; console.log(url);
                        // window.location.href = url;
                        location.reload();
                    } else {
                        pStart.style.display = 'none';
                    }
                })
                .catch((error) => {
                    console.log(error);
                    pStart.style.display = 'none';
                })
        }
    }
};

// Filter countries & cities
(function () {
    let country_select = document.getElementById('country-select');
    let city_select = document.getElementById('city-select');
    let category_select = document.getElementById('category-select');

    function createUrlByCountry() {
        let url = '/' + country_select.getAttribute('data-path');
        if (country_select && country_select.options[country_select.selectedIndex].value !== '') {
            url += '/' + country_select.options[country_select.selectedIndex].value;
        }
        if (category_select && category_select.options[category_select.selectedIndex].value !== '') {
            url += '/?category=' + category_select.options[category_select.selectedIndex].value;
        }
        return url;
    }

    if (country_select) {
        country_select.onchange = function () {
            window.location.href = createUrlByCountry();
        };
    }

    function createUrlByCity() {
        let url = '/' + city_select.getAttribute('data-path');
        if (city_select && city_select.options[city_select.selectedIndex].value === '') {
            url += '/' + country_select.options[country_select.selectedIndex].value;
        } else {
            url += '/' + country_select.options[country_select.selectedIndex].value + '/' + city_select.options[city_select.selectedIndex].value;
        }
        if (category_select && category_select.options[category_select.selectedIndex].value !== '') {
            url += '/?category=' + category_select.options[category_select.selectedIndex].value;
        }
        return url;
    }

    if (city_select) {
        city_select.onchange = function () {
            window.location.href = createUrlByCity();
        };
    }

    function createUrlByCategory() {
        let url = '/' + category_select.getAttribute('data-path');
        if (city_select && city_select.options[city_select.selectedIndex].value !== '') {
            url = createUrlByCity();
        } else if (country_select && country_select.options[country_select.selectedIndex].value !== '') {
            url = createUrlByCountry();
        }
        if (category_select.options[category_select.selectedIndex].value !== '' && url.indexOf('?category') === -1) {
            url += '/?category=' + category_select.options[category_select.selectedIndex].value;
        }
        return url;
    }

    if (category_select) {
        category_select.onchange = function () {
            window.location.href = createUrlByCategory();
        };
    }
}());

// Parallax
(function () {
    let enableParallax = false,
        mainSlider__image = document.querySelector('.mainSlider__slider'),
        mainSlider__bg = document.querySelector('.mainSlider__bg'),
        footer__bg = document.querySelector('.footer__bg'),
        footer__img = document.querySelector('.footer__img'),
        about__bg = document.querySelector('.pAbout__bg'),
        catalog__img = document.querySelector('.pCatalog__img'),
        catalog__bg = document.querySelector('.pCatalog__bg');

    function throttle(fn, threshhold, scope) {

        let last, deferTimer;

        threshhold || (threshhold = 250);

        return function () {

            let context = scope || this,
                now = +new Date,
                args = arguments;

            if (last && now < last + threshhold) {
                // hold on to it
                clearTimeout(deferTimer);

                deferTimer = setTimeout(function () {
                    last = now;
                    fn.apply(context, args);
                }, threshhold);
            }
            else {
                last = now;
                fn.apply(context, args);
            }
        };
    }

    function isEnabledParallax() {
        enableParallax = (window.innerWidth > 1200);
        if (enableParallax) {
            window.addEventListener('mousemove', parallax);
        } else {
            window.removeEventListener('mousemove', parallax);
            if (mainSlider__image) {
                mainSlider__image.style.webkitTransform = 'translate3d(0, 0, 0)';
                mainSlider__image.style.transform = 'translate3d(0, 0, 0)';
            }
            if (mainSlider__bg) {
                mainSlider__bg.style.webkitTransform = 'translate3d(0, 0, 0)';
                mainSlider__bg.style.transform = 'translate3d(0, 0, 0)';
            }
        }
    }

    let parallax = throttle(function (e) {
        let pageX = e.clientX,
            pageY = e.clientY;

        if (mainSlider__image) {
            mainSlider__image.style.webkitTransform = 'translate3d(' + pageX / 400 + '%, 0, 0)';
            mainSlider__image.style.transform = 'translate3d(' + pageX / 400 + '%, 0, 0)';
        }
        if (mainSlider__bg) {
            mainSlider__bg.style.webkitTransform = 'translate3d(' + pageX / 800 + '%, 0, 0)';
            mainSlider__bg.style.transform = 'translate3d(' + pageX / 800 + '%, 0, 0)';
        }
        if (footer__img) {
            footer__img.style.webkitTransform = 'translate3d(' + pageX / 400 + '%, 0, 0)';
            footer__img.style.transform = 'translate3d(' + pageX / 400 + '%, 0, 0)';
        }
        if (footer__bg) {
            footer__bg.style.webkitTransform = 'translate3d(' + pageX / 800 + '%, 0, 0)';
            footer__bg.style.transform = 'translate3d(' + pageX / 800 + '%, 0, 0)';
        }
        if (about__bg) {
            about__bg.style.webkitTransform = 'translate3d(-' + pageY / 500 + '%, 0, 0)';
            about__bg.style.transform = 'translate3d(-' + pageY / 500 + '%, 0, 0)';
        }
        if (catalog__img) {
            catalog__img.style.webkitTransform = 'translate3d(' + pageX / 400 + '%, 0, 0)';
            catalog__img.style.transform = 'translate3d(' + pageX / 400 + '%, 0, 0)';
        }
        if (catalog__bg) {
            catalog__bg.style.webkitTransform = 'translate3d(' + pageX / 800 + '%, 0, 0)';
            catalog__bg.style.transform = 'translate3d(' + pageX / 800 + '%, 0, 0)';
        }
    });

    window.addEventListener('resize', function (event) {
        isEnabledParallax();
    }, false);

    isEnabledParallax();

}());

// Scroll
(function () {
    let pAboutHistorySlider = document.getElementById('pAboutHistorySlider');
    if (pAboutHistorySlider) {
        let cordsObj = pAboutHistorySlider.getBoundingClientRect();
        pAboutHistorySlider.style.width = window.innerWidth - cordsObj.left - 17 + 'px';
        const ps = new PerfectScrollbar(pAboutHistorySlider, {
            wheelSpeed: 2,
            wheelPropagation: true,
            minScrollbarLength: 20,
            // useBothWheelAxes: true,
            // suppressScrollX: true,
            maxScrollbarLength: 70,
        });
    }
}());
(function () {
    let eSharpenerText = document.getElementsByClassName('eSharpener__text');
    if (eSharpenerText) {
        for (let i in eSharpenerText) {
            if (eSharpenerText.hasOwnProperty(i)) {
                const ps = new PerfectScrollbar(eSharpenerText[i], {
                    wheelSpeed: 2,
                    wheelPropagation: true,
                    minScrollbarLength: 20,
                    // useBothWheelAxes: true,
                    // suppressScrollX: true,
                    maxScrollbarLength: 70,
                });
            }
        }
    }
}());

// Sidebar
(function () {
    let body = document.getElementsByTagName('body')[0];
    let menuBtn = document.getElementById('menuBtn');
    let sidebarClose = document.getElementById('mSidebar__close');
    let sidebarShadow = document.getElementById('mSidebar__shadow');
    let sidebarHeader = document.querySelector('.mSidebar__col--header');
    let sidebarBody = document.querySelector('.mSidebar__col--body');
    let sidebarFooter = document.querySelector('.mSidebar__col--footer');
    let sidebarRow = document.querySelector('.mSidebar__row');
    let sidebarWrap = document.querySelector('.mSidebar__wrap');
    let mSidebar = document.querySelector('.mSidebar');
    if (menuBtn && mSidebar) {
        menuBtn.onclick = function () {
            body.classList.add('enableSidebar');
            body.classList.add('showSidebar');
            setSidebarMinHeight();
            setTimeout(function () {
                body.classList.add('showSidebarEffect');
            }, 800);
            setTimeout(function () {
                body.classList.remove('showSidebarEffect');
            }, 1500);
            return false;
        };

        function hideSidebar() {
            body.classList.remove('showSidebar');
            body.classList.add('hideSidebar');
            setTimeout(function () {
                body.classList.remove('hideSidebar');
                body.classList.remove('enableSidebar');
            }, 300);
        }

        sidebarShadow.onclick = function () {
            hideSidebar()
        };
        sidebarClose.onclick = function () {
            hideSidebar()
        };

        function setSidebarMinHeight() {
            let padding = parseInt(window.getComputedStyle(sidebarRow, null).getPropertyValue("padding-top"), 10) + parseInt(window.getComputedStyle(sidebarRow, null).getPropertyValue("padding-bottom"), 10)
            let height = sidebarHeader.offsetHeight + sidebarBody.offsetHeight + sidebarFooter.offsetHeight + padding * 2;
            if (height > window.innerHeight) {
                sidebarRow.style.height = height + padding + 'px';
                sidebarWrap.style.overflowY = 'scroll';
            } else {
                sidebarRow.style.height = '100%';
                sidebarWrap.style.overflowY = 'auto';
            }
        }

        window.addEventListener('resize', function (event) {
            setSidebarMinHeight();
        }, false);
    }
}());

// Seaarch
(function () {
    console.log('search');
    let body = document.getElementsByTagName('body')[0];
    let serchBtn = document.getElementById('searchBtn');
    let searchClose = document.getElementById('mSearch__close');
    let searchShadow = document.getElementById('mSearch__shadow');
    let mSearch = document.querySelector('.mSearch');
    if (serchBtn && mSearch) {
        serchBtn.onclick = function () {
            console.log('searchBtn');
            body.classList.add('enableSearch');
            body.classList.add('showSearch');
            setTimeout(function () {
                body.classList.add('showSearchEffect');
            }, 800);
            setTimeout(function () {
                body.classList.remove('showSearchEffect');
            }, 1500);
            return false;
        };

        function hideSearch() {
            body.classList.remove('showSearch');
            body.classList.add('hideSearch');
            setTimeout(function () {
                body.classList.remove('hideSearch');
                body.classList.remove('enableSearch');
            }, 300);
        }

        searchShadow.onclick = function () {
            hideSearch()
        };
        searchClose.onclick = function () {
            hideSearch()
        };
    }
}());

// Footer menu
(function () {
    let footer__title = document.getElementsByClassName('footer__title');
    if (footer__title) {
        for (let i in footer__title) {
            if (footer__title.hasOwnProperty(i)) {
                footer__title[i].onclick = function (e) {
                    this.classList.toggle('open');
                    e.target.nextSibling.nextSibling.classList.toggle('show');
                }
            }
        }
    }
}());

// FAQ
(function () {
    let eFaq = document.getElementsByClassName('eFaq');
    if (eFaq) {
        for (let i in eFaq) {
            if (eFaq.hasOwnProperty(i)) {
                eFaq[i].onclick = function () {
                    this.classList.toggle('eFaq--close');
                    this.classList.toggle('eFaq--open');
                }
            }
        }
    }
}());

// Fix main slider tooltip
(function () {
    let toolTipDrop = document.querySelectorAll('.eTooltip__drop'),
        menu = document.querySelector('#mainMenu');

    window.addEventListener("resize", resizeThrottler, false);

    function resizeThrottler() {
        fixTooltipWidth();
    }

    function fixTooltipWidth() {
        if (menu && toolTipDrop && toolTipDrop.length) {
            let width = menu.offsetWidth;
            for (let i = 0; i < toolTipDrop.length; i++) {
                if (toolTipDrop.hasOwnProperty(i)) {
                    toolTipDrop[i].style.maxWidth = width + 'px';
                }
            }
        }
    }

    fixTooltipWidth();
}());

(function () {
   let sharpeners = document.querySelectorAll('.eSharpener a');
   sharpeners.forEach(sharpener => {
       sharpener.rel = 'nofollow';
   });
}());

$(document).ready(function () {

    "use strict";

    // Loader
    jQuery('#page-preloader').fadeOut('slow');
    jQuery('#page-preloader .spinner').fadeOut('slow');

    // Sliders
    $('#pProduct__images').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        asNavFor: '#pProduct__nav'
    });
    $('#pProduct__nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '#pProduct__images',
        dots: false,
        arrows: false,
        centerMode: false,
        focusOnSelect: true
    });

    // Sticky
    function toggleStickyBlocks() {
        if ($(window).width() < 1200) {
            $(".stickInParentBox").trigger("sticky_kit:detach");
        } else {
            $(".stickInParentBox").stick_in_parent();
        }
        $(".header").stick_in_parent();
    }

    toggleStickyBlocks();


    // Filter
    $(document).on('click', '.bMarketing .bFilter__btn a', function () {
        $(document).find('.bMarketing .bFilter__box').slideToggle();
        return false;
    });
    $('.bFilterGroup__btn').on('click', function () {
        $(this).next('.bFilterGroup__box').slideToggle();
        return false;
    });

    // Fix Height for block in about pages
    function fixHeightAboutBlocks() {
        $('.pAbout__image').each(function () {
            let height;
            if ($(window).width() >= 1200) {
                height = $(this).innerHeight() + 'px';
            } else {
                height = 'auto'
            }
            $(this).parent().css({
                minHeight: height,
            });
        });
    }

    fixHeightAboutBlocks();


    // Fix image width for About pages
    function fixAboutImageWidth() {
        let pAboutHeader__wrap = $('.pAboutHeader__wrap');
        if (pAboutHeader__wrap.length) {
            if ($(window).width() >= 1200) {
                let width = $(window).innerWidth() - pAboutHeader__wrap.offset().left;
                pAboutHeader__wrap.css('width', width + 'px');
            } else {
                pAboutHeader__wrap.css('width', 'auto');
            }
        }
    }

    fixAboutImageWidth();

    // Resize
    $(window).resize(function () {
        fixHeightAboutBlocks();
        toggleStickyBlocks();
        fixAboutImageWidth();
    });


    // Popups
    $('.popup-ifrane').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
    });

    $('.open-popup-link').magnificPopup({
        type: 'inline',
        midClick: true
    });

    if ($('#coocie-popup').length) {
        console.log('ee');
        $('.coocie-popup-link').magnificPopup({
            type: 'inline',
            midClick: true
        });
        $('.coocie-popup-link').click();
        $('.bottom-popup .mfp-close').click(function () {
            axios.post('/set-first-visit')
                .then((response) => {
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        });
    }

    let textShowAll = 'Показать все',
        textHide = 'Скрыть';

    if (document.documentElement.lang === 'en') {
        textShowAll = 'Show all';
        textHide = 'Hide';
    } else if (document.documentElement.lang === 'ua') {
        textShowAll = 'Показати усi';
        textHide = 'Сховати';
    }
    else if (document.documentElement.lang === 'pt') {
        textShowAll = 'Mostre tudo';
        textHide = 'Ocultar';
    }
    else if (document.documentElement.lang === 'es') {
        textShowAll = 'Mostrar todo';
        textHide = 'Esconder';
    }



    if ($('.pProduct__features--forSorting').length) {
        $('.pProduct__features--forSorting .row').each(function () {
            let html = '',
                obj = {},
                ordered = {},
                thisRow = $(this);
            thisRow.find('.col').each(function () {
                obj[$(this).data('title')] = '<div class="col">' + $(this).html() + '</div>';
            });
            Object.keys(obj).sort().forEach(function (key) {
                ordered[key] = obj[key];
            });
            $.each(ordered, function (key) {
                html += ordered[key];
            });
            thisRow.html(html);

            let minHeight = thisRow.find('.col').innerHeight(),
                height = thisRow.innerHeight();
            thisRow.attr('data-height', height);
            thisRow.css({
                height: minHeight + 'px'
            });
            if (height > minHeight) {
                thisRow.parent().append('<p class="pProduct__featuresLink"><a href="#">' + textShowAll + '</a></p>');
            }
        });
    }
    $(document).on('click', '.pProduct__featuresLink a', function (e) {
        e.preventDefault();
        if ($(this).text() === textShowAll) {
            $(this).text(textHide);
            $(this).parents('.pProduct__features').find('.row').css({
                height: $(this).parents('.pProduct__features').find('.row').data('height') + 'px'
            })
        } else {
            $(this).text(textShowAll);
            $(this).parents('.pProduct__features').find('.row').css({
                height: $(this).parents('.pProduct__features').find('.col').innerHeight()
            })
        }
    });

    // Buy
    $('.buySelect__btn').on('click', function (e) {
        e.preventDefault();
        $(this).parents('.buySelect').toggleClass('open');
    });
    $(document).on('click', function (event) {
        if (!$(event.target).closest('.buySelect').length && $('.buySelect').hasClass('open')) {
            $('.buySelect').removeClass('open');
        }
    });

    $('.content > iframe').each(function () {
        $(this).wrap('<div class="iframeBox--big"></div>');
    });

});
