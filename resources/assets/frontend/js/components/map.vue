<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-6 col-xl-5">
                    <div class="pContacts__box">
                        <h3 class="pContacts__title">{{ trans('main.contacts_text') }}</h3>
                        <form @submit.prevent="submit" class="pContacts__form mForm">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <p class="mForm__row">
                                        <select class="mForm__select"
                                                :class="{active: current_country_id}"
                                                v-model="current_country_id"
                                                name="country">
                                            <option :value="null">{{ trans('main.choose_country') }}</option>
                                            <option v-for='country in countries'
                                                    :value="country.id"
                                                    v-html="country.title"></option>
                                        </select>
                                        <span class="mForm__error" v-if="errors['country']">
                                            <span v-for="error in errors['country']">
                                                {{ error }}
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <p class="mForm__row">
                                        <select class="mForm__select"
                                                :class="{active: form.subject}"
                                                v-model="form.subject"
                                                name="subject">
                                            <option :value="null">{{ trans('main.choose_subject') }}</option>
                                            <option :value="trans('main.sales')">{{ trans('main.sales') }}</option>
                                            <option :value="trans('main.marketing')">{{ trans('main.marketing') }}
                                            </option>
                                            <option :value="trans('main.career')">{{ trans('main.career') }}</option>
                                        </select>
                                        <span class="mForm__error" v-if="errors['subject']">
                                            <span v-for="error in errors['subject']">
                                                {{ error }}
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <p class="mForm__row">
                                        <input class="mForm__input" type="text" v-model="form.name"
                                               :placeholder="trans('main.name')">
                                        <span class="mForm__error" v-if="errors['name']">
                                            <span v-for="error in errors['name']">
                                                {{ error }}
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <p class="mForm__row">
                                        <input class="mForm__input" type="text" v-model="form.surname"
                                               :placeholder="trans('main.surname')">
                                        <span class="mForm__error" v-if="errors['surname']">
                                            <span v-for="error in errors['surname']">
                                                {{ error }}
                                            </span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="row" v-if="form.subject === trans('main.sales')">
                                <div class="col-xs-12 col-md-6">
                                    <p class="mForm__row">
                                        <input class="mForm__input" type="text" v-model="form.post"
                                               :placeholder="trans('main.post')">
                                        <span class="mForm__error" v-if="errors['post']">
                                            <span v-for="error in errors['post']">
                                                {{ error }}
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <p class="mForm__row">
                                        <input class="mForm__input" type="text" v-model="form.company_name"
                                               :placeholder="trans('main.company_name')">
                                        <span class="mForm__error" v-if="errors['company_name']">
                                            <span v-for="error in errors['company_name']">
                                                {{ error }}
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-xs-12">
                                    <p class="mForm__row">
                                        <input class="mForm__input" type="text" v-model="form.city"
                                               :placeholder="trans('main.city')">
                                        <span class="mForm__error" v-if="errors['city']">
                                            <span v-for="error in errors['city']">
                                                {{ error }}
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-xs-12">
                                    <p class="mForm__label">
                                        {{ trans('main.business') }}
                                        <span>
                                            ({{ trans('main.multi_desc') }})
                                        </span>
                                    </p>
                                    <p class="mForm__row">
                                        <select class="mForm__select--multi" v-model="form.business" name="subject"
                                                multiple>
                                            <option :value="trans('main.retail_trade_through')">{{
                                                trans('main.retail_trade_through') }}
                                            </option>
                                            <option :value="trans('main.retail_trade_outlet')">{{
                                                trans('main.retail_trade_outlet') }}
                                            </option>
                                            <option :value="trans('main.wholesale_trade_online')">{{
                                                trans('main.wholesale_trade_online') }}
                                            </option>
                                            <option :value="trans('main.wholesale_trade_shop')">{{
                                                trans('main.wholesale_trade_shop') }}
                                            </option>
                                            <option :value="trans('main.training_center')">{{
                                                trans('main.training_center') }}
                                            </option>
                                            <option :value="trans('main.nail_technician')">{{
                                                trans('main.nail_technician') }}
                                            </option>
                                            <option :value="trans('main.sharpener_of_manicure_tools')">{{
                                                trans('main.sharpener_of_manicure_tools') }}
                                            </option>
                                            <option :value="trans('main.distributor')">{{ trans('main.distributor') }}
                                            </option>
                                            <option :value="trans('main.specialized_salons')">{{
                                                trans('main.specialized_salons') }}
                                            </option>
                                            <option :value="trans('main.chain_store')">{{ trans('main.chain_store') }}
                                            </option>
                                            <option :value="trans('main.other')">{{ trans('main.other') }}</option>
                                        </select>
                                        <span class="mForm__error" v-if="errors['business']">
                                            <span v-for="error in errors['business']">
                                                {{ error }}
                                            </span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <p class="mForm__row">
                                        <input class="mForm__input" type="text" v-model="form.phone"
                                               :placeholder="trans('main.phone')">
                                        <span class="mForm__error" v-if="errors['phone']">
                                            <span v-for="error in errors['phone']">
                                                {{ error }}
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <p class="mForm__row">
                                        <input class="mForm__input" type="text" v-model="form.email"
                                               placeholder="E-mail">
                                        <span class="mForm__error" v-if="errors['email']">
                                            <span v-for="error in errors['email']">
                                                {{ error }}
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-xs-12">
                                    <p class="mForm__row">
                                        <input class="mForm__input" type="text" v-model="form.web"
                                               :placeholder="trans('main.web')">
                                    </p>
                                </div>
                                <div class="col-xs-12">
                                    <p class="mForm__row">
                                        <textarea class="mForm__textarea"
                                                  v-model="form.message"
                                                  :placeholder="trans('main.describe_question')">
                                        </textarea>
                                    </p>
                                </div>
                            </div>
                            <br>
                            <p class="mForm__row eCheckBoxRow" :class="{error: errors['term_1']}">
                                <span class="eCheckBox">
                                    <input type="checkbox" id="term_1" v-model="form.term_1">
                                    <span class="eCheckBox__el"></span>
                                </span>
                                <label for="term_1">
                                    {{ trans('main.i_confirm_18') }}
                                </label>
                            </p>
                            <p class="mForm__row eCheckBoxRow" :class="{error: errors['term_2']}">
                                <span class="eCheckBox">
                                    <input type="checkbox" id="term_2" v-model="form.term_2">
                                    <span class="eCheckBox__el"></span>
                                </span>
                                <label for="term_2">
                                    {{ trans('main.i_have_read_policy') }}
                                </label>
                            </p>
                            <p class="mForm__row eCheckBoxRow">
                                <span class="eCheckBox">
                                    <input type="checkbox" id="term_3" v-model="form.term_3">
                                    <span class="eCheckBox__el"></span>
                                </span>
                                <label for="term_3">
                                    {{ trans('main.i_want_to_receive_email') }}
                                </label>
                            </p>
                            <p class="mForm__btn--right">
                                <button class="eBtn--white">
                                    {{ trans('main.send') }}
                                </button>
                            </p>
                            <div v-if="done">
                                <p class="mForm__success">
                                    {{ trans('main.thank_you_for_your_application') }}
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-6 col-xl-7">
                    <div class="countriesMap">
                        <gmap-map
                            ref="map"
                            :center="center"
                            :zoom="zoom"
                            :bounds="bounds"
                            :options="options">
                            <gmap-info-window
                                :options="infoOptions"
                                :position="infoWindowPos"
                                :opened="infoWinOpen"
                                @closeclick="infoWinOpen=false">
                                {{infoContent}}
                            </gmap-info-window>
                            <gmap-marker
                                v-if="marker"
                                :position="marker.position"
                                :clickable="true"
                                :draggable="false"
                                :icon="marker.icon"
                                @click="toggleInfoWindow(marker)"
                            ></gmap-marker>
                        </gmap-map>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import * as VueGoogleMaps from 'vue2-google-maps';
    import Vue from 'vue';

    Vue.use(VueGoogleMaps, {
        load: {
            key: 'AIzaSyC7nl04gTQl-ZBg0gjus9KGEEOKiczTW7o',
            v: '3',
        }
    });

    export default {
        mounted: function () {
            console.log('countries mounted.');
            this.getCountries();
        },
        components: {VueGoogleMap},
        ready: function () {
            window.addEventListener('resize', function () {
                this.fitBounds();
            })
        },
        beforeDestroy: function () {
            window.removeEventListener('resize', function () {
                this.fitBounds();
            })
        },
        props: ['locale'],
        data() {
            return {
                center: {lat: 49.023470, lng: 31.630266},
                zoom: 12,
                bounds: {},
                infoContent: '',
                infoWindowPos: {
                    lat: 0,
                    lng: 0
                },
                infoWinOpen: false,
                currentMidx: null,
                infoOptions: {
                    pixelOffset: {
                        width: 0,
                        height: -20
                    }
                },
                options: {
                    scrollwheel: false,
                    draggable: true,
                    disableDoubleClickZoom: true,
                    mapTypeControl: false,
                    scaleControl: false,
                    streetViewControl: false,
                    rotateControl: false,
                    fullscreenControl: false,
                    zoomControl: false,
                    styles: [{
                        "featureType": "administrative",
                        "elementType": "labels",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "administrative.country",
                        "elementType": "geometry.stroke",
                        "stylers": [{"visibility": "on"}]
                    }, {
                        "featureType": "administrative.province",
                        "elementType": "geometry.stroke",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "landscape",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "on"}, {"color": "#e3e3e3"}]
                    }, {
                        "featureType": "landscape.natural",
                        "elementType": "labels",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [{"visibility": "off", "color": "#cccccc"}]
                    }, {
                        "featureType": "road",
                        "elementType": "labels",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "transit",
                        "elementType": "labels.icon",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "transit.line",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "transit.line",
                        "elementType": "labels.text",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "transit.station.airport",
                        "elementType": "geometry",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "transit.station.airport",
                        "elementType": "labels",
                        "stylers": [{"visibility": "off"}]
                    }, {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [{"color": "#FFFFFF"}]
                    }, {
                        "featureType": "water",
                        "elementType": "labels",
                        "stylers": [{"visibility": "off"}]
                    }]
                },
                countries: {},
                country_category: {},
                current_country: null,
                current_country_id: null,
                current_category: null,
                marker: null,
                isFormValid: false,
                done: false,
                loading: false,
                form: {
                    country: null,
                    subject: null,
                    name: null,
                    surname: null,
                    post: null,
                    company_name: null,
                    city: null,
                    business: [],
                    message: null,
                    email: null,
                    phone: null,
                    web: null,
                    term_1: false,
                    term_2: false,
                    term_3: false,
                },
                errors: {
                    subject: null,
                    name: null,
                    surname: null,
                    post: null,
                    company_name: null,
                    city: null,
                    business: null,
                    message: null,
                    email: null,
                    phone: null,
                    web: null,
                    term_1: null,
                    term_2: null,
                    term_3: null,
                }
            }
        },
        watch: {
            // current_category: function (val) {
            //     this.markers = this.allMarkers[val];
            //     this.fitBounds();
            // }
            current_country_id: function (val) {
                let current_country = _.find(this.countries, (country) => {
                    return country.id === val
                });
                this.setCountry(current_country);
                this.$set(this.form, 'country', this.current_country.title);
            }
        },
        methods: {
            getCountries() {
                console.log('getCountries');
                axios.get('/getCountries/' + this.locale)
                    .then((response) => {
                        this.$set(this, 'countries', response.data.countries);
                        this.$set(this, 'country_category', response.data.country_category);
                        let current_country = _.find(this.countries, (country) => {
                            return country.id === Number(response.data.country_id)
                        });
                        setTimeout(() => {
                            this.setCountry(current_country);
                        }, 1000);
                    })
                    .catch((error) => {
                        console.log(error)
                    });
            },
            setCountry(current_country) {
                let current_category = _.find(this.country_category, (category) => {
                    return category.id === current_country.country_category_id
                });
                this.$set(this, 'current_country', current_country);
                this.$set(this, 'current_category', current_category);
                let marker = {
                    position: {
                        lat: parseFloat(this.current_country.latitude),
                        lng: parseFloat(this.current_country.longitude)
                    },
                    infoText: this.current_country.title,
                    icon: {url: '/frontend/img/markerActive.svg'},
                };
                this.$set(this, 'marker', marker);
                setTimeout(() => {
                    this.fitBounds();
                }, 500);
            },
            toggleInfoWindow(marker) {
                console.log('toggleInfoWindow');
                // this.marker.icon = {url: '/frontend/img/markerActive.svg'};
                // this.infoWindowPos = marker.position;
                // this.infoContent = marker.infoText;
                // if (this.currentMidx === idx) {
                //     this.infoWinOpen = !this.infoWinOpen;
                // } else {
                //     this.infoWinOpen = true;
                //     this.currentMidx = idx;
                // }
            },
            fitBounds() {
                console.log('fitBounds');
                // this.infoWinOpen = false;
                return this.$refs.map.$mapCreated.then(() => {
                    let bounds = new google.maps.LatLngBounds();
                    bounds.extend(this.marker.position);
                    this.$refs.map.fitBounds(bounds);
                    this.$refs.map.$mapObject.setZoom(4);
                });
            },
            submit() {
                this.loading = true;
                console.log('Submit');

                let formData = new FormData();
                for (let key in this.form) {
                    if (this.form.hasOwnProperty(key) && this.form[key]) {
                        if (key === 'business') {
                            let str = this.form[key].join(', ');
                            if (str.length) {
                                formData.append(key, str);
                            }
                        } else if (key === 'term_1' || key === 'term_2' || key === 'term_3') {
                            formData.append(key, this.form[key] ? 1 : 0);
                        } else {
                            formData.append(key, this.form[key]);
                        }
                    }
                }

                if (this.form.subject === this.trans('main.sales')) {
                    formData.append('sales', '1');
                }

                let current_category_slug = null;
                if (this.current_category.slug === 'ukraine') {
                    current_category_slug = 'ukraine';
                } else if (this.current_category.slug === 'europe') {
                    current_category_slug = 'europe';
                } else if (this.current_category.slug === 'russia') {
                    current_category_slug = 'russia';
                } else if (this.current_category.slug === 'other') {
                    if (this.current_country.title === 'США' || this.current_country.title === 'США' || this.current_country.title === 'USA') {
                        current_category_slug = 'usa';
                    } else {
                        current_category_slug = 'other';
                    }
                }
                formData.append('country_category', current_category_slug);

                console.log(formData);
                axios.post('/add-contact-request', formData)
                    .then((response) => {
                        console.log('Submit success');
                        for (let key in this.form) {
                            if (this.form.hasOwnProperty(key)) {
                                if (key !== 'country') {
                                    this.form[key] = (key === 'business') ? [] : null;
                                }
                            }
                        }
                        this.done = true;
                        this.loading = false;
                        this.isFormValid = false;
                        setTimeout(() => {
                            this.done = false;
                            $.magnificPopup.close();
                        }, 5000)
                    })
                    .catch((error) => {
                        console.log(error);
                        let errors = JSON.parse(error.response.request.response).errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                this.errors[key] = errors[key];
                            }
                        }
                        setTimeout(() => {
                            this.clearErrors();
                        }, 3000)
                    });
            },
            clearErrors() {
                for (let key in this.errors) {
                    if (this.errors.hasOwnProperty(key)) {
                        this.errors[key] = null;
                    }
                }
            }
        }
    }
</script>