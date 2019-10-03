<template>
    <div>
        <div class="marketingForm">
            <h3 class="marketingForm__title">
                {{ trans('main.marketing_support') }}
            </h3>
            <form @submit.prevent="submit" class="mForm">
                <div class="mForm__row">
                    <input type="text" v-model="form.name" :placeholder="trans('main.name')">
                    <span class="error" v-if="errors['name']">
                    <span v-for="error in errors['name']">
                        {{ error }}
                    </span>
                </span>
                </div>
                <div class="mForm__row">
                    <input type="surname" v-model="form.surname" :placeholder="trans('main.surname')">
                    <span class="error" v-if="errors['surname']">
                    <span v-for="error in errors['surname']">
                        {{ error }}
                    </span>
                </span>
                </div>
                <div class="mForm__row">
                    <input type="tel" v-model="form.phone" :placeholder="trans('main.phone')">
                    <span class="error" v-if="errors['phone']">
                    <span v-for="error in errors['phone']">
                        {{ error }}
                    </span>
                </span>
                </div>
                <div class="mForm__row">
                    <input type="email" v-model="form.email" placeholder="E-mail">
                    <span class="error" v-if="errors['email']">
                    <span v-for="error in errors['email']">
                        {{ error }}
                    </span>
                </span>
                </div>
                <div class="mForm__row">
                    <textarea v-model="form.text" :placeholder="trans('main.your_text')"></textarea>
                    <span class="error" v-if="errors['text']">
                    <span v-for="error in errors['text']">
                        {{ error }}
                    </span>
                </span>
                </div>
                <button class="eBtn--red" type="submit">
                    {{ trans('main.send') }}
                </button>
                <span class="success" v-if="done">
                {{ trans('main.subscribe_success') }}
            </span>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Marketing support form mounted.')
        },
        data: function () {
            return {
                form: {
                    name: null,
                    surname: null,
                    phone: null,
                    email: null,
                    text: null,
                },
                errors: {
                    name: null,
                    surname: null,
                    phone: null,
                    email: null,
                    text: null,
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
                axios.post('/marketing-support-form', self.form)
                    .then(function (response) {
                        for (let key in self.form) {
                            self.form[key] = null;
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
                        for (let key in errors) {
                            self.errors[key] = errors[key];
                        }
                        setTimeout(function () {
                            self.clearErrors();
                        }, 4000)
                    });
            },
            clearErrors: function () {
                for (let key in this.errors) {
                    this.errors[key] = false;
                }
            },
        }
    }
</script>
