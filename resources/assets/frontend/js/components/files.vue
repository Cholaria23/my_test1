<template>
    <div class="bMarketing gridRow" v-if="data">
        <div class="row">
            <div class="col-xs-12 col-lg-3">
                <div class="bMarketing__filter">
                    <div class="bFilter">
                        <div class="bFilter__header">
                            <h3 class="bFilter__title">
                                {{ trans('main.marketing_support_title') }}
                            </h3>
                        </div>
                        <div class="bFilter__btn">
                            <a href="#" class="eBtn--black">
                                {{ trans('main.filter') }}
                            </a>
                        </div>
                        <div class="bFilter__box">
                            <p v-for="(cat, index) in categories" class="bFilter__filterItem">
                                <span class="eCheckBox">
                                    <input type="checkbox" :id="'cat-' + cat.id" v-on:change="setToFilter(cat.id)">
                                    <span class="eCheckBox__el"></span>
                                </span>
                                <label :for="'cat-' + cat.id">
                                    {{ getTranslation(cat, 'title') }}
                                </label>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-lg-9">
                <div class="bDocs">
                    <div class="gridRow" v-for="(page, index) in chunk_files">
                        <transition-group name="fade">
                            <div class="row" v-if="index < pages_count" v-bind:key="index">
                                <div v-for="(doc, key) in page"
                                     class="col-xs-6 col-md-4">
                                    <div class="bDocs__item">
                                        <a class="eDoc" @click.prevent="openFile(doc)">
                                            <span :class="[doc.image ? 'eDoc__body--image' : 'eDoc__body--empty']">
                                                <span class="eDoc__icon">
                                                    <svg width="81px" height="90px">
                                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                             :xlink:href="'#doc-' + doc.icon"></use>
                                                    </svg>
                                                </span>
                                                <span class="eDoc__img">
                                                    <img v-if="doc.image" :src="doc.thumb_image_url" :alt="doc.title">
                                                    <svg v-else="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 235"
                                                         width="340px" height="235px">
                                                        <rect width="340" height="235" fill="none"/>
                                                    </svg>
                                                </span>
                                            </span>
                                            <span class="eDoc__title">
                                                {{ getTranslation(doc, 'title') }}
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </transition-group>
                    </div>
                    <div class="bDocs__more" v-if="pages_count < chunk_files.length">
                        <a class="eBtn--black" @click.prevent="loadMore()">
                            {{ trans('main.show_more') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="password-modal" class="white-popup--small mfp-hide">
            <form class="mForm" @submit.prevent="submitPassword()">
                <h3 class="mForm__title">{{ trans('main.access_to_files') }}</h3>
                <div v-if="!done && !answer">
                    <div class="mForm__row">
                        <input type="password" v-model="form.password" class="mForm__input" :placeholder="trans('main.password')">
                            <span class="mForm__error" v-if="answer === false">
                                {{ trans('main.password_false') }}
                            </span>
                    </div>
                    <button type="submit" class="eBtn--black">
                        {{ trans('main.send') }}
                    </button>
                </div>
                <span class="mForm__success--top" v-else-if="done && answer">
                    {{ trans('main.password_true') }}
                </span>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Files mounted');
            this.getData();
        },
        data: function () {
            return {
                data: null,
                chunk_files: {},
                categories: {},
                pages_count: 1,
                filter: [],
                form: {
                    password: null,
                },
                answer: null,
                done: false
            }
        },
        props: ['locale'],
        watch: {
            data: function () {
                this.chunk_files = this.data.chunk_files;
                this.categories = this.data.categories;
            },
            filter: function () {
                if (this.filter.length) {
                    let str = this.filter.toString().replace(/\,/g, '_');
                    this.getData(str);
                } else {
                    this.getData();
                }
            }
        },
        methods: {
            getTranslation(entity, field) {
                let trans = _.filter(entity.translations, (item) => {
                    return item.locale === this.locale;
                });
                return trans[0][field];
            },
            getData(filter = null) {
                let url = filter ? '/getFiles/' + filter : '/getFiles';
                this.pages_count = 1;
                axios.get(url)
                    .then(response => {
                        this.data = response.data;
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            openFile(doc) {
                if (doc.path === undefined || doc.url === undefined) {
                    $.magnificPopup.open({
                        items: {
                            src: '#password-modal',
                        },
                        type: 'inline'
                    });
                } else {
                    let hiddenLinkID = 'hiddenDownloader',
                        link = document.getElementById(hiddenLinkID);
                    if (link === null) {
                        link = document.createElement('a');
                        link.id = hiddenLinkID;
                        link.style.display = 'none';
                        link.setAttribute('target','_blank');
                        document.body.appendChild(link);
                    }
                    link.setAttribute('download', doc.title);
                    if (doc.url) {
                        link.setAttribute('href', doc.url);
                    } else {
                        link.setAttribute('href', 'https://staleks.com/' + doc.path);
                    }
                    link.click();
                }
            },
            setToFilter(id) {
                let index = this.filter.indexOf(id);
                if (index === -1) {
                    this.filter.push(id);
                } else {
                    this.filter.splice(index, 1);
                }
            },
            loadMore() {
                this.pages_count += 1;
            },
            submitPassword() {
                axios.post('/checkPassword', this.form)
                    .then(response => {
                        this.answer = response.data.answer;
                        if (this.answer) {
                            this.done = true;
                            setTimeout(() => {
                                if (this.answer) {
                                    $.magnificPopup.close();
                                    this.getData();
                                }
                                this.done = false;
                                this.answer = null;
                            }, 3000);
                        } else {
                            setTimeout(() => {
                                this.answer = null;
                            }, 3000);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
</script>