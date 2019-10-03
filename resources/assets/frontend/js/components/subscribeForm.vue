<template>
    <div>
        <form @submit.prevent="submit" class="subscribeForm">
            <div class="subscribeForm__row">
                <h3 class="subscribeForm__title">
                    {{ trans('main.subscribe_title') }}
                </h3>
                <div class="subscribeForm__box">
                    <input class="subscribeForm__input" type="email" v-model="form.email" placeholder="E-mail">
                    <button class="subscribeForm__btn" type="submit">
                        <span class="text">
                            {{ trans('main.send') }}
                        </span>
                        <span class="icon">
                            <svg width="25px" height="25px">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-send"></use>
                            </svg>
                        </span>
                    </button>
                    <span class="subscribeForm__error" v-if="errors['email']">
                        <span v-for="error in errors['email']">
                            {{ error }}
                        </span>
                    </span>
                    <span class="subscribeForm__success" v-if="done">
                        {{ trans('main.subscribe_success') }}
                    </span>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Subscribe form mounted.')
        },
        data: function () {
            return {
                form: {
                    email: null
                },
                errors: {
                    email: null
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
                axios.post('/subscribe-form', self.form)
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
                        errors = errors.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                self.errors[key] = errors[key];
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
        }
    }
</script>
