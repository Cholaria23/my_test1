<template>
    <div>
        <div class="mainSlider">

            <div class="mainSlider__arrow" @click.prevent="toggleSlider()">
                <span class="logo">
                    <svg width="24px" height="30px">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logo"></use>
                    </svg>
                </span>
                <span class="box">
                    <span class="text" style="margin:10px;">
                          <template v-if="is_pro">
                            {{ trans('main.home_slider_btn_1') }}
                          </template>
                          <template v-else>
                            {{ trans('main.home_slider_btn_2') }}
                          </template>
                    </span>
                    <span class="arrow">
                        <svg width="26px" height="12px">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use>
                        </svg>
                    </span>
                </span>
            </div>

            <div class="container">
                <div class="mainSlider__wrap">

                    <div class="mainSlider__box">
                        <div class="mainSlider__list">
                            <div class="mainSlider__item">
                                <div class="mainSlider__bg">
                                    <span>
                                        <svg version="1.1"
                                             id="mainSlider__bg"
                                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                             x="0px" y="0px" width="1820.7px" height="1967.1px" viewBox="0 0 1820.7 1967.1"
                                             style="enable-background:new 0 0 1820.7 1967.1;" xml:space="preserve">
                                            <path fill='currentColor' d="M1620.7,0H200H0v1967.1h200h1420.7h200V0H1620.7z M1505.3,1042.8l-593.5,824.3h-1.7v-450.3c0-58-32.7-111.1-84.6-137.2
                                                l-481.8-242.9c-39.2-19.8-55-67.5-35.2-106.8c1.9-3.7,4-7.3,6.5-10.7l589-830c1.1-1.5,3.2-1.9,4.7-0.8c0.9,0.6,1.4,1.7,1.4,2.8
                                                v441.7c0,58,32.7,111.1,84.5,137.2l481.9,242.9C1520.1,947.3,1533.9,1003.1,1505.3,1042.8z"/>
                                        </svg>
                                    </span>
                                </div>
                                <div class="mainSlider__slider">

                                    <div class="mainSlider__imageBox" v-for="(item, index) in currentSlide"
                                         v-bind:key="index"
                                         :class="{'active' : index == currentIndex}">
                                        <div class="mainSlider__image"
                                             v-bind:style="{ backgroundImage: 'url(' + item.image + ')' }">
                                        </div>
                                    </div>

                                </div>
                                <div class="mainSlider__dots">
                                    <span class="mainSlider__element" id="mainSlider__element"></span>
                                    <ul id="mainSlider__dot">
                                        <li>
                                            <span v-html="currentSlide[currentIndex].title"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mainSlider__menu">
                        <div class="mainMenu" id="mainMenu">
                            <div class="mainMenu__box">
                                <div class="mainMenu__item">
                                    <p class="mainMenu__label" v-if="is_pro" v-html="trans('main.home_slider_title_1')"></p>
                                    <p class="mainMenu__label" v-else="" v-html="trans('main.home_slider_title_2')"></p>
                                    <template v-for="(item, index) in currentSlide">
                                        <p>
                                            <span class="mainMenu__link"
                                                  :class="{'active' : index === currentIndex}"
                                                  @click.prevent="goOnSlide(index)">
                                                <span v-html="item.title"></span>
                                                <a href="#" class="eTooltip">
                                                    <svg width="27px" height="27px">
                                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-info"></use>
                                                    </svg>
                                                    <div class="eTooltip__drop">
                                                        {{ item.text }}
                                                    </div>
                                                </a>
                                            </span>
                                        </p>
                                        <hr v-if="index + 1 < currentSlide.length">
                                    </template>
                                </div>
                            </div>
                        </div>
                        <div class="mainSlider__btn">
                            <a :href="is_pro ? (locale == 'ru' ? '' : locale)  + '/catalog-pro' : (locale == 'ru' ? '' : locale) + '/catalog'" :class="is_pro ? 'eBtn--white' : 'eBtn--black'">
                                {{ trans('main.catalog2') }}
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="infoSlider">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-lg-6">
                        <p class="infoSlider__label">{{ trans('main.features') }}</p>
                        <h3 class="infoSlider__title" v-html="is_pro ? 'STALEKS PRO' : 'STALEKS'"></h3>
                        <ul class="infoSlider__content" id="infoSlider__content">
                            <li>
                                <transition name="fade">
                                    <span class="infoSlider__num" v-html="currentInfoIndex + 1"></span>
                                </transition>
                                <transition name="fade">
                                    <p v-html="currentInfo[currentInfoIndex].text"></p>
                                </transition>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-lg-6">
                        <div class="infoSlider__wrap">
                            <ul class="infoSlider__images" id="infoSlider__images">
                                <li class="bg">
                                    <svg width="48px" height="60px">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logo"></use>
                                    </svg>
                                </li>
                                <li class="img" id="infoSlider__image">
                                    <transition name="fade">
                                        <img :src="currentInfo[currentInfoIndex].image"
                                             :alt="is_pro ? 'STALEKS PRO' : 'STALEKS'">
                                    </transition>
                                </li>
                            </ul>
                            <ul class="infoSlider__dots">
                                <li v-for="(item, index) in currentInfo"
                                    @click.prevent="infoSliderToggle(index)"
                                    :class="{'active' : index === currentInfoIndex}">
                                    <svg width="14px" height="28px">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#icon-arrow-top"></use>
                                    </svg>
                                </li>
                            </ul>
                            <div class="infoSlider__arrows">
                                <a @click.prevent="infoSliderToggle(currentInfoIndex === 0 ? currentInfo.length - 1 : currentInfoIndex - 1)"
                                   class="infoSlider__prev">
                                    <svg width="28px" height="14px">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#icon-arrow-prev"></use>
                                    </svg>
                                </a>
                                <a @click.prevent="infoSliderToggle(currentInfoIndex === currentInfo.length - 1 ? 0 : currentInfoIndex + 1)"
                                   class="infoSlider__next">
                                    <svg width="28px" height="14px">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import anime from 'animejs'

    export default {
        mounted() {
            let self = this;
            console.log('Main slider mounted.');
            self.resetSlider();
            // window.addEventListener('resize', function (event) {
            //     self.isEnabledParallax();
            // }, false);
            // self.isEnabledParallax();
        },
        props: ['locale'],
        data: function () {
            return {
                is_pro: true,
                slides: {
                    slide1: [
                        {
                            image: 'frontend/img/mainslider/slider-1.jpg',
                            title: 'EXCLUSIVE',
                            link: '/catalog-pro/series/exclusive',
                            text: this.trans('main.slide1_1')
                        },
                        {
                            image: 'frontend/img/mainslider/slider-5.jpg',
                            title: 'EXPERT',
                            link: '/catalog-pro/series/expert',
                            text: this.trans('main.slide1_2')
                        },
                        {
                            image: 'frontend/img/mainslider/slider-6.jpg',
                            title: 'SMART',
                            link: '/catalog-pro/series/smart',
                            text: this.trans('main.slide1_3')
                        },
                        {
                            image: 'frontend/img/mainslider/slider-6.jpg',
                            title: 'PODO',
                            link: '/catalog-pro/series/podo',
                            text: this.trans('main.slide1_3')
                        }
                    ],
                    slide2: [
                        {
                            image: 'frontend/img/mainslider/slider-3.jpg',
                            title: 'BEAUTY & CARE',
                            link: '/catalog/series/beauty-care',
                            text: this.trans('main.slide2_1')
                        },
                        {
                            image: 'frontend/img/mainslider/slider-4.jpg',
                            title: 'СLASSIC',
                            link: '/catalog/series/classic',
                            text: this.trans('main.slide2_2')
                        },
                    ]
                },
                features: {
                    features1: [
                        {
                            text: this.trans('main.features1_1'),
                            image: 'frontend/img/features/features1.jpg',
                        },
                        {
                            text: this.trans('main.features1_2'),
                            image: 'frontend/img/features/features2.jpg',
                        },
                        {
                            text: this.trans('main.features1_3'),
                            image: 'frontend/img/features/features3.jpg',
                        },
                        {
                            text: this.trans('main.features1_4'),
                            image: 'frontend/img/features/features4.jpg',
                        },
                        {
                            text: this.trans('main.features1_5'),
                            image: 'frontend/img/features/features5.jpg',
                        }
                    ],
                    features2: [
                        {
                            text: this.trans('main.features2_1'),
                            image: 'frontend/img/features/features6.jpg',
                        },
                        {
                            text: this.trans('main.features2_2'),
                            image: 'frontend/img/features/features7.jpg',
                        },
                        {
                            text: this.trans('main.features2_3'),
                            image: 'frontend/img/features/features8.jpg',
                        }
                    ],
                },
                currentIndex: 0,
                currentInfoIndex: 0,
            }
        },
        computed: {
            currentSlide: function () {
                return this.is_pro ? this.slides.slide1 : this.slides.slide2;
            },
            currentInfo: function () {
                return this.is_pro ? this.features.features1 : this.features.features2;
            }
        },
        methods: {
            toggleSlider() {
                let self = this;
                let wrapper = document.getElementById('wrapper');
                anime({
                    targets: '#mainMenu',
                    translateX: [
                        {value: -500, duration: 500, easing: 'easeOutExpo'},
                        {value: 0, duration: 500, delay: 500, easing: 'easeOutExpo'}
                    ]
                });
                anime({
                    targets: '#mainSlider__bg',
                    scale: [
                        {value: 0.8, duration: 500, easing: 'easeOutExpo'},
                        {value: 1, duration: 500, delay: 500, easing: 'easeOutExpo'}
                    ]
                });
                setTimeout(function () {
                    self.is_pro = !self.is_pro;
                    wrapper.classList.toggle('black');
                    wrapper.classList.toggle('white');
                    self.resetSlider();
                }, 500);
            },
            resetSlider() {
                let self = this;
                self.currentIndex = 0;
                self.currentInfoIndex = 0;
            },
            goOnSlide(index) {
                let self = this;

                anime({
                    targets: '#mainSlider__element',
                    height: [
                        {value: '0px', duration: 300, delay: 0, elasticity: 300},
                        {value: '145px', duration: 400, delay: 300, easing: 'easeInOutBack'},
                    ]
                });
                anime({
                    targets: '#mainSlider__bg',
                    scale: [
                        {value: 0.9, duration: 500, easing: 'easeOutExpo'},
                        {value: 1, duration: 500, delay: 500, easing: 'easeOutExpo'}
                    ]
                });
                anime({
                    targets: '#mainSlider__dot',
                    opacity: [
                        {value: 0, duration: 300, delay: 0, easing: 'linear'},
                        {value: 1, duration: 300, delay: 350, easing: 'linear'},
                    ],
                    translateY: [
                        {value: '45px', duration: 300, delay: 0, easing: 'easeInOutBack'},
                        {value: 0, duration: 300, delay: 350, easing: 'easeInOutBack'},
                    ]
                });

                setTimeout(function () {
                    self.currentIndex = index;
                }, 300);
            },
            infoSliderToggle(index) {
                let self = this;
                anime({
                    targets: '#infoSlider__content',
                    opacity: [
                        {value: 0, duration: 100, delay: 150, easing: 'linear'},
                        {value: 1, duration: 100, delay: 250, easing: 'linear'},
                    ],
                    translateX: [
                        {value: '-30px', duration: 250, delay: 0, easing: 'easeInOutQuad'},
                        {value: 0, duration: 250, delay: 250, easing: 'easeInOutQuad'},
                    ]
                });
                anime({
                    targets: '#infoSlider__images',
                    translateY: [
                        {value: '15px', duration: 250, delay: 0, easing: 'easeInOutQuart'},
                        {value: 0, duration: 250, delay: 250, easing: 'easeInOutQuart'},
                    ]
                });
                anime({
                    targets: '#infoSlider__image',
                    opacity: [
                        {value: 0, duration: 100, delay: 150, easing: 'linear'},
                        {value: 1, duration: 100, delay: 250, easing: 'linear'},
                    ],
                });
                setTimeout(function () {
                    self.currentInfoIndex = index;
                }, 250);
            },
        }
    }
</script>
