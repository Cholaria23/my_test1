<template>
    <div>

        <form class="mForm" @submit.prevent="submit">
            <div class="mForm__row">
                <div class="mForm__rating row" :data-stars="form.rating ? form.rating : 0">
                    <div class="star col">
                        <svg width="30px" height="29px" data-rating="1" @click="selectRating(1)">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#star"></use>
                        </svg>
                    </div>
                    <div class="star col">
                        <svg width="30px" height="29px" data-rating="2" @click="selectRating(2)">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#star"></use>
                        </svg>
                    </div>
                    <div class="star col">
                        <svg width="30px" height="29px" data-rating="3" @click="selectRating(3)">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#star"></use>
                        </svg>
                    </div>
                    <div class="star col">
                        <svg width="30px" height="29px" data-rating="4" @click="selectRating(4)">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#star"></use>
                        </svg>
                    </div>
                    <div class="star col">
                        <svg width="30px" height="29px" data-rating="5" @click="selectRating(5)">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#star"></use>
                        </svg>
                    </div>
                </div>
                <span class="mForm__error" v-if="errors['rating']">
                    <span v-for="error in errors['rating']">
                        {{ error }}
                    </span>
                </span>
            </div>
            <div class="mForm__row">
                <textarea v-model="form.content" id="" cols="30" rows="10" class="mForm__textarea" :placeholder="trans('main.comment')"></textarea>
                <span class="mForm__error" v-if="errors['content']">
                    <span v-for="error in errors['content']">
                        {{ error }}
                    </span>
                </span>
            </div>
            <div class="row">
                <div class="col-xs-12 col-lg-3">
                    <div class="mForm__row">
                        <input type="text" class="mForm__input" :placeholder="trans('main.name')" v-model="form.name">
                        <span class="mForm__error" v-if="errors['name']">
                            <span v-for="error in errors['name']">
                                {{ error }}
                            </span>
                        </span>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-3">
                    <div class="mForm__row">
                        <input type="tel" class="mForm__input" :placeholder="trans('main.phone')" v-model="form.phone">
                        <span class="mForm__error" v-if="errors['phone']">
                            <span v-for="error in errors['phone']">
                                {{ error }}
                            </span>
                        </span>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-3">
                    <div class="mForm__row">
                        <input type="text" class="mForm__input" :placeholder="trans('main.service')" v-model="form.service">
                        <span class="mForm__error" v-if="errors['service']">
                            <span v-for="error in errors['service']">
                                {{ error }}
                            </span>
                        </span>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-3">
                    <button type="submit" class="mForm__btn eBtn--black">
                        {{ trans('main.add') }}
                    </button>
                </div>
            </div>
            <span class="mForm__success--top" v-if="done">
                {{ trans('main.review_success') }}
            </span>

        </form>

    </div>
</template>

<script>
    import anime from 'animejs';

    export default {
        mounted() {

        },
        props: ['id'],
        data: function () {
            return {
                form: {
                    content: null,
                    name: null,
                    phone: null,
                    rating: null,
                    service: null,
                    commentable_id: this.id
                },
                errors: {
                    content: null,
                    name: null,
                    phone: null,
                    rating: null,
                    service: null,
                },
                isFormValid: false,
                done: false,
                loading: false
            }
        },
        methods: {
            submit: function () {
                let self = this;
                self.loading = true;
                console.log('submit');
                axios.post('/add-review', self.form)
                    .then(function (response) {
                        for (let key in self.form) {
                            if (self.form.hasOwnProperty(key)) {
                                self.form[key] = null;
                            }
                        }
                        self.done = true;
                        self.loading = false;
                        self.isFormValid = false;
                        setTimeout(function () {
                            self.done = false;
                        }, 4000)
                    })
                    .catch(function (error) {
                        console.log(error);
                        let errors = JSON.parse(error.response.request.response);
                        for (let key in errors.errors) {
                            if (errors.errors.hasOwnProperty(key)) {
                                self.errors[key] = errors.errors[key];
                            }
                        }
                        setTimeout(function () {
                            self.clearErrors();
                        }, 4000)
                    });
            },
            clearErrors: function () {
                for (let key in this.errors) {
                    if (this.errors.hasOwnProperty(key)) {
                        this.errors[key] = false;
                    }
                }
            },
            selectRating(i) {
                this.form.rating = i;
            }
        }
    }
</script>