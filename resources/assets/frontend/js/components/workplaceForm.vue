<template>
    <div>
        <form @submit.prevent="submit" class="mForm" enctype="multipart/form-data">
            <h3 class="mForm__title--center">
                {{ trans('main.workplaceFrom_title') }}
            </h3>
            <div class="mForm__row">
                <div class="mForm__uploadFile">
                    <input id="fileInput" type="file" @change="selectFile">
                    {{ trans('main.download_summary') }}
                </div>
                <span class="mForm__uploadFileDesc">
                    {{ trans('main.file_size') }}
                </span>
                <span class="mForm__error" v-if="errors['file']">
                    <span v-for="error in errors['file']">
                        {{ error }}
                    </span>
                </span>
            </div>
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
            <p class="mForm__success" v-if="done">
                {{ trans('main.workplace_success') }}
            </p>
        </form>
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
                axios.post('/workplace-form', formData)
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
                        document.querySelector('#fileInput').value = '';
                        setTimeout(function () {
                            self.done = false;
                        }, 3000)
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
                        }, 3000)
                    });
            },
            clearErrors: function () {
                for (let key in this.errors) {
                    this.errors[key] = false;
                }
            },
            selectFile: function () {
                this.form['file'] = document.querySelector('#fileInput').files[0];
            }
        }
    }
</script>
