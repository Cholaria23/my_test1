<template>
    <div>
        <form @submit.prevent="submit" class="mForm" enctype="multipart/form-data">
            <h3 v-if="form_type === 'ask'" class="mForm__title--center">
                {{ trans('main.have_question') }}
            </h3>
            <h3 v-else-if="form_type === 'cooperation'" class="mForm__title--center">
                {{ trans('main.application_for_cooperation') }}
            </h3>
            <h3 v-else-if="form_type === 'shop'" class="mForm__title--center">
                {{ trans('main.feedback_form') }}
            </h3>
            <h3 v-else-if="form_type === 'sharpen'" class="mForm__title--center">
                {{ trans('main.sharpen_form') }}
            </h3>
            <h3 v-else-if="form_type === 'instructor'" class="mForm__title--center">
                {{ trans('main.become_an_instructor') }}
            </h3>
            <h3 v-else-if="form_type === 'technologists'" class="mForm__title--center">
                {{ trans('main.become_an_technologists') }}
            </h3>
            <h3 v-else="" class="mForm__title--center">
                {{ trans('main.feedback_form') }}
            </h3>
            <div class="mForm__row">
                <input type="text" class="mForm__input" v-model="form.name" :placeholder="trans('main.name')">
                <span class="mForm__error" v-if="errors['name']">
                    <span v-for="error in errors['name']">
                        {{ error }}
                    </span>
                </span>
            </div>
            <div class="mForm__row">
                <input type="text" class="mForm__input" v-model="form.surname" :placeholder="trans('main.surname')">
                <span class="mForm__error" v-if="errors['surname']">
                    <span v-for="error in errors['surname']">
                        {{ error }}
                    </span>
                </span>
            </div>
            <div class="mForm__row">
                <input type="tel" class="mForm__input" v-model="form.phone" :placeholder="trans('main.phone')">
                <span class="mForm__error" v-if="errors['phone']">
                    <span v-for="error in errors['phone']">
                        {{ error }}
                    </span>
                </span>
            </div>
            <div class="mForm__row">
                <input type="email" class="mForm__input" v-model="form.email" placeholder="E-mail">
                <span class="mForm__error" v-if="errors['email']">
                    <span v-for="error in errors['email']">
                        {{ error }}
                    </span>
                </span>
            </div>
            <div class="mForm__row">
                <textarea v-model="form.text" class="mForm__textarea" :placeholder="trans('main.your_text')"></textarea>
                <span class="mForm__error" v-if="errors['text']">
                    <span v-for="error in errors['text']">
                        {{ error }}
                    </span>
                </span>
            </div>
            <button class="eBtn--black mForm__btn" type="submit">
                {{ trans('main.send') }}
            </button>
            <div v-if="done">
                <p v-if="form_type === 'ask'" class="mForm__success">
                    {{ trans('main.ask_success') }}
                </p>
                <p v-else-if="form_type === 'cooperation'" class="mForm__success">
                    {{ trans('main.thank_you_for_your_application') }}
                </p>
                <p v-else-if="form_type === 'shop'" class="mForm__success">
                    {{ trans('main.thank_you_for_your_application') }}
                </p>
                <p v-else-if="form_type === 'instructor'" class="mForm__success">
                    {{ trans('main.thank_you_for_your_application') }}
                </p>
                <p v-else-if="form_type === 'technologists'" class="mForm__success">
                    {{ trans('main.thank_you_for_your_application') }}
                </p>
                <p v-else="" class="mForm__success">
                    {{ trans('main.thank_you_for_your_application') }}
                </p>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Ask form form mounted.');
        },
        props: ['variation'],
        data: function () {
            return {
                form_type: window['form_type_' + this.variation],
                form: {
                    file: null,
                    name: null,
                    surname: null,
                    phone: null,
                    email: null,
                    text: null,
                },
                errors: {
                    file: null,
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
                console.log('Submit');
                let formData = new FormData();
                for (let key in self.form) {
                    if (self.form.hasOwnProperty(key) && self.form[key]) {
                        formData.append(key, self.form[key]);
                    }
                }
                formData.append('subject', window['form_subject_' + this.variation]);
                axios.post('/add-form-request', formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                    .then(function (response) {
                        console.log('Submit success');
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
                            $.magnificPopup.close();
                        }, 3000)
                    })
                    .catch(function (error) {
                        console.log(error);
                        let errors = JSON.parse(error.response.request.response);
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                self.errors[key] = errors[key];
                            }
                        }
                        setTimeout(function () {
                            self.clearErrors();
                        }, 3000)
                    });
            },
            clearErrors: function () {
                for (let key in this.errors) {
                    this.errors[key] = false;
                }
            }
        }
    }
</script>
