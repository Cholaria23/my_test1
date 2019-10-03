<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-4">
                    <div class="blockPro__text">
                        <p v-if="sliderCount === 0">
                            {{ trans('main.blockPro__text__1_' + variation) }}
                        </p>
                        <p v-else-if="sliderCount === 1">
                            {{ trans('main.blockPro__text__2_' + variation) }}
                        </p>
                        <p v-else-if="sliderCount === 2">
                            {{ trans('main.blockPro__text__3_' + variation) }}
                        </p>
                        <p v-else-if="sliderCount === 3">
                            {{ trans('main.blockPro__text__4_' + variation) }}
                        </p>
                        <p v-else-if="sliderCount === 4">
                            {{ trans('main.blockPro__text__5_' + variation) }}
                        </p>
                        <p v-else-if="sliderCount === 5">
                            {{ trans('main.blockPro__text__6_' + variation) }}
                        </p>
                        <p v-else-if="sliderCount === 6">
                            {{ trans('main.blockPro__text__7_' + variation) }}
                        </p>
                        <p v-else-if="variation == 2 && sliderCount === 7">
                            {{ trans('main.blockPro__text__8_' + variation) }}
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-4">
                    <div class="blockPro__person">
                        <svg version="1.1"
                             class="circleSvg"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px" width="545.6px" height="545.6px" viewBox="0 0 545.6 545.6" style="enable-background:new 0 0 545.6 545.6;"
                             xml:space="preserve">
                            <circle class="circle" fill="none" stroke='white' stroke-miterlimit="10" stroke-dasharray="3%" cx="272.8" cy="272.8" r="272.3"/>
                        </svg>
                        <img class="blockPro__personImg" :src="'/frontend/img/exclusive/picture-pro-' + variation + '-' + imageIndex +'.jpg'" :alt="trans('main.product_pro_name')">
                    </div>
                </div>
                <div class="col-xs-12 col-lg-4">
                    <div class="row end-lg">
                        <div class="col blockPro__col">
                            <h3 class="blockPro__titleSmall">
                                {{ trans('main.blockPro__title') }}
                            </h3>
                            <ul class="blockPro__list">
                                <li class="blockPro__listCursor">
                                    <!--v-bind:style="cursorStile"-->
                                    <svg width="10px" height="15px" class="pink">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="#icon-logo-small"></use>
                                    </svg>
                                </li>
                                <li @click="toggleSlider(0)" :class="[sliderCount === 0 ? 'active' : '']"
                                    id="blockPro__item--0">
                                    {{ trans('main.blockPro__item__1_' + variation) }}
                                </li>
                                <li @click="toggleSlider(1)" :class="[sliderCount === 1 ? 'active' : '']"
                                    id="blockPro__item--1">
                                    {{ trans('main.blockPro__item__2_' + variation) }}
                                </li>
                                <li @click="toggleSlider(2)" :class="[sliderCount === 2 ? 'active' : '']"
                                    id="blockPro__item--2">
                                    {{ trans('main.blockPro__item__3_' + variation) }}
                                </li>
                                <li @click="toggleSlider(3)" :class="[sliderCount === 3 ? 'active' : '']"
                                    id="blockPro__item--3">
                                    {{ trans('main.blockPro__item__4_' + variation) }}
                                </li>
                                <li @click="toggleSlider(4)" :class="[sliderCount === 4 ? 'active' : '']"
                                    id="blockPro__item--4">
                                    {{ trans('main.blockPro__item__5_' + variation) }}
                                </li>
                                <li @click="toggleSlider(5)" :class="[sliderCount === 5 ? 'active' : '']"
                                    id="blockPro__item--5">
                                    {{ trans('main.blockPro__item__6_' + variation) }}
                                </li>
                                <li @click="toggleSlider(6)" :class="[sliderCount === 6 ? 'active' : '']"
                                    id="blockPro__item--6">
                                    {{ trans('main.blockPro__item__7_' + variation) }}
                                </li>
                                <li v-if="variation == 2" @click="toggleSlider(7)" :class="[sliderCount === 7 ? 'active' : '']"
                                    id="blockPro__item--7">
                                    {{ trans('main.blockPro__item__8_' + variation) }}
                                </li>
                            </ul>
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
            console.log('Person slider mounted')
        },
        props: ['variation'],
        data: function () {
            return {
                sliderCount: 0,
                is_toggle: false,
                imageIndex: 1
            }
        },
        watch: {
            sliderCount: {
                handler: function(val, oldVal) {
                    setTimeout(() => {
                        this.imageIndex = this.sliderCount + 1;
                    }, 200);
                }
            }
        },
        methods: {
            toggleSlider(i) {
                if (!this.is_toggle) {
                    let item = document.getElementById('blockPro__item--' + i),
                        distance = item.offsetTop;
                    setTimeout(() => {
                        this.sliderCount = i;
                    }, 250);
                    this.is_toggle = true;


                    anime({
                        targets: '.blockPro__listCursor',
                        translateY: [
                            {value: distance, duration: 400, easing: 'easeOutExpo'},
                        ],
                        scale: [
                            {value: 1, duration: 100, easing: 'linear'},
                            {value: 1.2, duration: 200, delay: 100, easing: 'linear'},
                            {value: 1, duration: 100, delay: 100, easing: 'linear'}
                        ],
                        opacity: [
                            {value: .5, duration: 100, easing: 'linear'},
                            {value: 1, duration: 200, delay: 100, easing: 'linear'},
                            {value: .5, duration: 100, delay: 300, easing: 'linear'}
                        ],
                        elasticity: 1000,
                        complete: (anim) => {

                        }
                    });
                    anime({
                        targets: '.blockPro__personImg',
                        scale: [
                            {value: 1, duration: 150, easing: 'linear'},
                            {value: .9, duration: 50, delay: 150, easing: 'linear'},
                            {value: 1, duration: 150, delay: 300, easing: 'linear'}
                        ],
                        opacity: [
                            {value: 1, duration: 150, easing: 'linear'},
                            {value: 0, duration: 100, delay: 150, easing: 'linear'},
                            {value: 1, duration: 150, delay: 250, easing: 'linear'}
                        ],
                        elasticity: 1000,
                        complete: (anim) => {

                        }
                    });

                    anime({
                        targets: '.circle',
                        strokeDasharray: [
                            {value: ['3%'], duration: 100, easing: 'linear'},
                            {value: ['10%'], duration: 200, delay: 100, easing: 'linear'},
                            {value: ['3%'], duration: 100, delay: 300, easing: 'linear'},
                        ],
                        elasticity: 1000,
                        complete: (anim) => {
                        }
                    });

                    anime({
                        targets: '.circleSvg',
                        rotate: [
                            {value: 0, duration: 100, easing: 'easeOutExpo'},
                            {value: 10, duration: 200, delay: 100, easing: 'easeOutExpo'},
                            {value: 0, duration: 100, delay: 300, easing: 'easeOutExpo'},
                        ],
                        elasticity: 1000,
                        complete: (anim) => {
                        }
                    });

                    anime({
                        targets: '.blockPro__text',
                        translateY: [
                            {value: 0, duration: 100, easing: 'easeOutExpo'},
                            {value: 20, duration: 200, delay: 100, easing: 'easeOutExpo'},
                            {value: 0, duration: 100, delay: 300, easing: 'easeOutExpo'},
                        ],
                        opacity: [
                            {value: 1, duration: 100, easing: 'linear'},
                            {value: 0, duration: 200, delay: 100, easing: 'linear'},
                            {value: 1, duration: 100, delay: 300, easing: 'linear'}
                        ],
                        elasticity: 1000,
                        complete: (anim) => {
                            this.is_toggle = false;
                        }
                    });
                }
            }
        }
    }
</script>