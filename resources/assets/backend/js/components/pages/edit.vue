<template>
    <div>

        <vue-message v-if="message.show" :message="message"></vue-message>

        <form v-on:submit.prevent="onSubmit" name="update" class="form">
            <div v-if="update" class="form__update">
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1"></div>
                    <div class="sk-child sk-bounce2"></div>
                    <div class="sk-child sk-bounce3"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <i class="fa fa-edit"></i> <strong>{{ object.title_single }}</strong>
                                    <small v-if="this.pageType === 'store'">(create)</small>
                                    <small v-else-if="this.pageType === 'edit'">(update)</small>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <ul class="nav nav-tabs">
                                        <li v-for="language in languages" class="nav-item">
                                            <a :class="[language == activeLanguage ? 'nav-link active' : 'nav-link']"
                                               @click.prevent="setActiveLanguage(language)"
                                               v-html="language"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div v-if="!loading" class="card-block">
                            <div v-for="column in object.columns" v-if="column.position === 'main'">
                                <vue-form-fields
                                        :column="column"
                                        :item="entityData"
                                        :activeLanguage="activeLanguage"
                                >
                                </vue-form-fields>
                            </div>
                            <div v-for="column in object.columns" v-if="column.position === 'advanced'">
                                <vue-form-fields
                                        v-if="entityData.fields.hasOwnProperty(column.advanced_name)"
                                        :column="column"
                                        :item="entityData"
                                        :activeLanguage="activeLanguage"
                                >
                                </vue-form-fields>
                            </div>
                        </div>
                        <div v-else class="card-block">
                            <div class="sk-three-bounce">
                                <div class="sk-child sk-bounce1"></div>
                                <div class="sk-child sk-bounce2"></div>
                                <div class="sk-child sk-bounce3"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card" v-if="this.object.gallery">
                        <div class="card-header">
                            <i class="fa fa-image"></i> <strong>Gallery</strong>
                        </div>
                        <div v-if="!loading" class="card-block">
                            <div v-for="column in object.columns" v-if="column.position === 'gallery'">
                                <vue-form-fields
                                    :column="column"
                                    :errors.sync="errors"
                                    :item.sync="entityData"
                                    :activeLanguage="activeLanguage"
                                >
                                </vue-form-fields>
                            </div>
                        </div>
                        <div v-else class="card-block">
                            <div class="sk-three-bounce">
                                <div class="sk-child sk-bounce1"></div>
                                <div class="sk-child sk-bounce2"></div>
                                <div class="sk-child sk-bounce3"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card" v-if="this.object.seo">
                        <div class="card-header">
                            <i class="fa fa-line-chart"></i> <strong>SEO</strong>
                        </div>
                        <div v-if="!loading" class="card-block">
                            <div v-for="column in object.columns" v-if="column.position === 'seo'">
                                <vue-form-fields
                                        :column="column"
                                        :errors.sync="errors"
                                        :item.sync="entityData"
                                        :activeLanguage="activeLanguage"
                                >
                                </vue-form-fields>
                            </div>
                        </div>
                        <div v-else class="card-block">
                            <div class="sk-three-bounce">
                                <div class="sk-child sk-bounce1"></div>
                                <div class="sk-child sk-bounce2"></div>
                                <div class="sk-child sk-bounce3"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xs-12 col-md-4">
                    <div v-if="pageArias.image" class="card">
                        <div class="card-header">
                            <i class="fa fa-image"></i> <strong>Image</strong>
                            <small>(preview)</small>
                        </div>
                        <div v-if="!loading" class="card-block">
                            <div v-for="column in object.columns" v-if="column.position === 'image'">
                                <vue-form-fields
                                        :column="column"
                                        :errors.sync="errors"
                                        :item.sync="entityData"
                                >
                                </vue-form-fields>
                            </div>
                        </div>
                        <div v-else class="card-block">
                            <div class="sk-three-bounce">
                                <div class="sk-child sk-bounce1"></div>
                                <div class="sk-child sk-bounce2"></div>
                                <div class="sk-child sk-bounce3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-gear"></i> <strong>Settings</strong>
                        </div>
                        <div v-if="!loading" class="card-block">
                            <div v-for="column in object.columns" v-if="column.position === 'side-top'">
                                <vue-form-fields
                                        :column="column"
                                        :errors.sync="errors"
                                        :item.sync="entityData"
                                        :activeLanguage="activeLanguage"
                                >
                                </vue-form-fields>
                            </div>
                            <div v-for="column in object.columns" v-if="column.position === 'side'">
                                <vue-form-fields
                                        :column="column"
                                        :errors.sync="errors"
                                        :item.sync="entityData"
                                        :activeLanguage="activeLanguage"
                                >
                                </vue-form-fields>
                            </div>
                            <div v-for="column in object.columns" v-if="column.position === 'side-bottom'">
                                <vue-form-fields
                                        :column="column"
                                        :errors.sync="errors"
                                        :item.sync="entityData"
                                        :activeLanguage="activeLanguage"
                                >
                                </vue-form-fields>
                            </div>
                            <div class="form-actions">
                                <button @click.prevent="saveItem" type="submit" class="btn btn-primary">Save changes
                                </button>
                                <button @click.prevent="resetItem" type="button" class="btn btn-default">Cancel</button>
                                <button v-if="this.pageType === 'edit' && this.object.delete" @click.prevent="deleteItem" class="btn btn-danger" type="button">Delete</button>
                            </div>
                        </div>
                        <div v-else class="card-block">
                            <div class="sk-three-bounce">
                                <div class="sk-child sk-bounce1"></div>
                                <div class="sk-child sk-bounce2"></div>
                                <div class="sk-child sk-bounce3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</template>

<script>
    import {slugify} from 'transliteration';
    export default {
        data() {
            return {
                id: null,
                entityData: {},
                pageName: null,
                pageType: null,
                object: {},
                errors: [],
                loading: false,
                update: false,
                message: {
                    show: false,
                    text: false,
                    type: false
                },
                pageArias: {
                    image: false
                },
                mainLanguage: this.$store.state.mainLanguage,
                languages: this.$store.state.languages,
                activeLanguage: this.$store.state.mainLanguage,
                enableWatchToSlug: false
            }
        },
        created() {
            this.getPageType();
        },
        mounted() {
            console.log('Admin edit page mounted.');
            this.id = this.$route.params.id;
            this.object = this.$store.state[this.pageName];
            this.object.columns.forEach((item, i, arr) => {
                if (item.position === 'image') {
                    this.pageArias.image = true;
                }
            });
            if (this.pageType === 'edit') {
                this.getItem();
            } else if (this.pageType === 'store') {
                this.getEmptyItem();
            }
            this.$bus.$on('editDate', (event) => {
                let data = event.data.replace('T', ' ') + ':00';
                this.$set(this.entityData, event.field, data);
            });
        },
        beforeDestroy() {
            this.$bus.$off("validationErrorsEvent");
        },
        watch: {
            'entityData.translations.ru.title': function () {
                if (this.enableWatchToSlug) {
                    this.entityData.slug = slugify(this.entityData.translations.ru.title);
                }
                this.enableWatchToSlug = true;
            },
            'entityData.slug': function () {
                this.entityData.slug = slugify(this.entityData.slug);
            }
        },
        methods: {
            getPageType() {
                let routeName = this.$route.name;
                let pathArray = routeName.split('_');
                this.pageName = pathArray[0];
                this.pageType = pathArray[1];
            },
            getEmptyItem() {
                // Create empty title & slug in entity object for transliteration
                let columns = this.object.columns;
                let obj = {
                    translations: {}
                };

                this.languages.forEach((item) => {
                    let langObj = {};
                    columns.forEach((column) => {
                        if (column.create) {
                            if (column.translated) {
                                langObj[column.field] = '';
                            } else if (['slug', 'string', 'textarea'].indexOf(column.type) !== -1) {
                                obj[column.field] = '';
                            } else if (['belongsTo', 'belongsToMany', 'select'].indexOf(column.type) !== -1) {
                                obj[column.field] = null;
                            } else if (column.type === 'image') {
                                obj[column.field] = null;
                            } else if (column.type === 'morphMany' && column.position === 'gallery') {
                                obj[column.field] = [{image: null}];
                            }
                        }
                    });
                    obj['translations'][item] = langObj;
                });

                this.entityData = obj;
            },
            createItem() {
                this.update = true;
                let formData = new FormData();
                for (let key in this.entityData) {
                    if (this.entityData.hasOwnProperty(key)) {
                        if (key === 'translations') {
                            for (let lang in this.entityData[key]) {
                                if (this.entityData[key].hasOwnProperty(lang)) {
                                    for (let index in this.entityData[key][lang]) {
                                        if (this.entityData[key][lang].hasOwnProperty(index)) {
                                            formData.append('translations.' + lang + '.' + index, this.entityData[key][lang][index])
                                        }
                                    }
                                }
                            }
                        } else if (key === 'pictures') {
                            let pictures_count = 0;
                            for (let picture in this.entityData[key]) {
                                if (this.entityData[key].hasOwnProperty(picture) && this.entityData[key][picture]['image']) {
                                    formData.append(key + '_' + picture, this.entityData[key][picture]['image']);
                                    pictures_count = Number(picture) + 1;
                                }
                            }
                            if (pictures_count) {
                                formData.append('pictures_count', String(pictures_count));
                            }
                        } else {
                            formData.append(key, this.entityData[key]);
                        }
                    }
                }
                axios.post('/admin/' + this.pageName + '/store', formData)
                    .then((response) => {
                        this.entityData = response.data.item;
                        this.errors = [];
                        this.update = false;
                        this.$router.push({name: this.pageName + '_edit', params: {id: response.data.item.id}});
                    })
                    .catch((error) => {
                        console.log(error);
                        this.update = false;
                        this.showMessage('error', '"' + this.object.title_single + '" create error. Please check and fill all fields', error);
                    })
            },
            getItem() {
                this.loading = true;
                axios.post('/admin/' + this.pageName + '/show/' + this.id)
                    .then((response) => {
                        this.entityData = this.remodelData(response.data.item);
                        this.errors = [];
                        this.loading = false;
                    })
                    .catch((error) => {
                        console.log(error);
                        this.loading = false;
                    })
            },
            saveItem() {
                switch (this.pageType) {
                    case 'edit':
                        this.updateItem();
                        break;
                    case 'store':
                        this.createItem();
                        break;
                }
            },
            updateItem() {
                this.update = true;
                let formData = new FormData();
                for (let key in this.entityData) {
                    if (this.entityData.hasOwnProperty(key)) {
                        if (key === 'translations') {
                            for (let lang in this.entityData[key]) {
                                if (this.entityData[key].hasOwnProperty(lang)) {
                                    for (let index in this.entityData[key][lang]) {
                                        if (this.entityData[key][lang].hasOwnProperty(index)) {
                                            formData.append('translations_' + lang + '_' + index, this.entityData[key][lang][index])
                                        }
                                    }
                                }
                            }
                        } else if (key === 'pictures') {
                            let pictures_count = 0;
                            for (let picture in this.entityData[key]) {
                                if (this.entityData[key].hasOwnProperty(picture) && this.entityData[key][picture]['image']) {
                                    formData.append(key + '_' + picture, this.entityData[key][picture]['image']);
                                    pictures_count = Number(picture) + 1;
                                }
                            }
                            if (pictures_count) {
                                formData.append('pictures_count', String(pictures_count));
                            }
                        } else if (key === 'fields') {
                            formData.append('fields', JSON.stringify(this.entityData[key]));
                        } else {
                            formData.append(key, this.entityData[key]);
                        }
                    }
                }
                axios.post('/admin/' + this.pageName + '/update/' + this.id, formData)
                    .then((response) => {
                        console.log('Update item');
                        this.update = false;
                        this.entityData = this.remodelData(response.data.item);
                        this.errors = [];
                        this.showMessage('success', '"' + this.object.title_single + '" update successfully'); // TODO: show error on incorrect field
                    })
                    .catch((error) => {
                        console.log(error);
                        this.update = false;
                        this.showMessage('error', '"' + this.object.title_single + '" update error. Please check and fill all fields', error);
                    });
            },
            resetItem() {
                console.log('resetItem');
                this.getItem();
            },
            deleteItem() {
                axios.delete('/admin/' + this.pageName + '/destroy/' + this.id)
                    .then((response) => {
                        console.log('Delete item');
                        this.$router.push({name: this.pageName});
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            showMessage(type, text, error = null) {
                if (error !== null) {

                    let errors = JSON.parse(error.response.request.response);
                    for (let key in errors.errors) {
                        if (errors.errors.hasOwnProperty(key)) {
                            this.errors[key] = errors.errors[key];
                        }
                    }

                    for (let key in this.errors) {
                        let keyArray = _.split(key, '_');
                        let error_lang =  keyArray[1];
                        if (keyArray[0] === 'translations') {
                            _.reverse(keyArray);
                            if (!this.errors.hasOwnProperty(keyArray[0])) {
                                let langError = [];
                                langError[error_lang] = this.errors[key];
                                if (keyArray.length === 4) {
                                    this.errors[keyArray[1] + '_' + keyArray[0]] = langError;
                                } else {
                                    this.errors[keyArray[0]] = langError;
                                }
                            } else {
                                this.errors[keyArray[0]][keyArray[1]] = this.errors[key];
                            }

                            delete this.errors[key];
                        }
                    }

                    this.$bus.$emit('validationErrorsEvent', {
                        errors: this.errors
                    });
                }

                this.message.show = true;
                this.message.type = type;
                this.message.text = text;

                setTimeout(() => {
                    this.message.show = false;
                    this.message.type = false;
                    this.message.text = false;
                    this.errors = [];
                }, 5000);
            },
            setActiveLanguage(lang) {
                this.activeLanguage = lang;
            },
            remodelData(data) {
                let translations = {};
                if (data.hasOwnProperty('translations')) {
                    data.translations.forEach((lang, i, arr) => {
                        translations[lang.locale] = lang;
                    });
                }
                data.translations = translations;

                let fields = {};
                if (data.hasOwnProperty('fields')) {
                    data.fields.forEach((field, i, arr) => {

                        translations = {};
                        if (field.hasOwnProperty('translations')) {
                            field.translations.forEach((lang, i, arr) => {
                                translations[lang.locale] = lang;
                            });
                        }
                        field.translations = translations;

                        fields[field.advanced_name] = field;
                    });
                }
                data.fields = fields;

                if (data.hasOwnProperty('pictures')) {
                    data.pictures.push({image: null});
                }

                return data;
            }
        }
    }
</script>