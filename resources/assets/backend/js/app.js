require('./../../bootstrap');
require('./jquery');

import Vue from 'vue';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import VueQuillEditor from 'vue-quill-editor';

Vue.use(Vuex);
Vue.use(VueRouter);
Vue.use(VueQuillEditor);

import Quill from 'quill';
// import {ImageImport} from './modules/ImageImport.js';
import {ImageResize} from './modules/ImageResize.js';
import {ImageUpload} from './modules/ImageUpload.js';

// Quill.register('modules/imageImport', ImageImport);
Quill.register('modules/imageResize', ImageResize);
Quill.register('modules/imageUpload', ImageUpload);

import {transliterate as tr, slugify} from 'transliteration';

Vue.config.devtools = true;
Vue.config.debug = true;
Vue.config.silent = true;

const Home = Vue.component('home', require('./components/pages/index.vue'));
const List = Vue.component('list', require('./components/pages/list.vue'));
const Edit = Vue.component('edit', require('./components/pages/edit.vue'));
const Empty = Vue.component('edit', require('./components/pages/empty.vue'));

Vue.component('vue-menu', require('./components/pages/parts/menu.vue'));
Vue.component('vue-list-row', require('./components/pages/parts/list-row.vue'));
Vue.component('vue-list-col', require('./components/pages/parts/list-col.vue'));
Vue.component('vue-form-fields', require('./components/pages/parts/form-fields.vue'));
Vue.component('vue-pagination', require('./components/pages/parts/pagination.vue'));
Vue.component('vue-message', require('./components/pages/parts/message.vue'));

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/blog',
        name: 'blog',
        redirect: {name: 'article'}
    },
    {
        path: '/article',
        component: Empty,
        children: [
            {
                path: '',
                name: 'article',
                component: List,
            },
            {
                path: '/article/edit/:id',
                name: 'article_edit',
                component: Edit,
                props: true
            },
            {
                path: '/article/create',
                name: 'article_store',
                component: Edit,
                props: true
            },
        ]
    },
    {
        path: '/articleCategory',
        component: Empty,
        children: [
            {
                path: '',
                name: 'articleCategory',
                component: List,
            },
            {
                path: '/articleCategory/edit/:id',
                name: 'articleCategory_edit',
                component: Edit,
                props: true
            },
            {
                path: '/articleCategory/create',
                name: 'articleCategory_store',
                component: Edit,
                props: true
            },
        ]
    },
    {
        path: '/workplace',
        component: Empty,
        children: [
            {
                path: '',
                name: 'workplace',
                component: List,
            },
            {
                path: '/workplace/edit/:id',
                name: 'workplace_edit',
                component: Edit,
                props: true
            },
            {
                path: '/workplace/create',
                name: 'workplace_store',
                component: Edit,
                props: true
            },
        ]
    },
    {
        path: '/poster',
        component: Empty,
        children: [
            {
                path: '',
                name: 'poster',
                component: List,
            },
            {
                path: '/poster/edit/:id',
                name: 'poster_edit',
                component: Edit,
                props: true
            },
            {
                path: '/poster/create',
                name: 'poster_store',
                component: Edit,
                props: true
            },
        ]
    },
    {
        path: '/page',
        component: Empty,
        children: [
            {
                path: '',
                name: 'page',
                component: List,
            },
            {
                path: '/page/edit/:id',
                name: 'page_edit',
                component: Edit,
                props: true
            },
            // {
            //     path: '/page/create',
            //     name: 'page_store',
            //     component: Edit,
            //     props: true
            // }
        ]
    },
    {
        path: '/formRequests',
        name: 'formRequests',
        redirect: {name: 'formRequest'}
    },
    {
        path: '/formRequest',
        component: Empty,
        children: [
            {
                path: '',
                name: 'formRequest',
                component: List,
            },
            {
                path: '/formRequest/edit/:id',
                name: 'formRequest_edit',
                component: Edit,
                props: true
            },
            {
                path: '/formRequest/create',
                name: 'formRequest_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/workplaceRequest',
        component: Empty,
        children: [
            {
                path: '',
                name: 'workplaceRequest',
                component: List,
            },
            {
                path: '/workplaceRequest/edit/:id',
                name: 'workplaceRequest_edit',
                component: Edit,
                props: true
            },
            {
                path: '/workplaceRequest/create',
                name: 'workplaceRequest_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/subscriber',
        component: Empty,
        children: [
            {
                path: '',
                name: 'subscriber',
                component: List,
            },
            {
                path: '/subscriber/edit/:id',
                name: 'subscriber_edit',
                component: Edit,
                props: true
            },
            {
                path: '/subscriber/create',
                name: 'subscriber_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/serviceCenters',
        component: Empty,
        children: [
            {
                path: '',
                name: 'serviceCenters',
                component: List,
            },
            {
                path: '/serviceCenters/edit/:id',
                name: 'serviceCenters_edit',
                component: Edit,
                props: true
            },
            {
                path: '/serviceCenters/create',
                name: 'serviceCenters_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/user',
        component: Empty,
        children: [
            {
                path: '',
                name: 'user',
                component: List,
            },
            {
                path: '/user/edit/:id',
                name: 'user_edit',
                component: Edit,
                props: true
            },
            {
                path: '/user/create',
                name: 'user_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/schools',
        component: Empty,
        children: [
            {
                path: '',
                name: 'schools',
                component: List,
            },
            {
                path: '/schools/edit/:id',
                name: 'schools_edit',
                component: Edit,
                props: true
            },
            {
                path: '/schools/create',
                name: 'schools_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/schoolCategory',
        component: Empty,
        children: [
            {
                path: '',
                name: 'schoolCategory',
                component: List,
            },
            {
                path: '/schoolCategory/edit/:id',
                name: 'schoolCategory_edit',
                component: Edit,
                props: true
            },
            {
                path: '/schoolCategory/create',
                name: 'schoolCategory_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/courses',
        component: Empty,
        children: [
            {
                path: '',
                name: 'courses',
                component: List,
            },
            {
                path: '/courses/edit/:id',
                name: 'courses_edit',
                component: Edit,
                props: true
            },
            {
                path: '/courses/create',
                name: 'courses_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/maintenanceCenters',
        component: Empty,
        children: [
            {
                path: '',
                name: 'maintenanceCenters',
                component: List,
            },
            {
                path: '/maintenanceCenters/edit/:id',
                name: 'maintenanceCenters_edit',
                component: Edit,
                props: true
            },
            {
                path: '/maintenanceCenters/create',
                name: 'maintenanceCenters_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/reviews',
        component: Empty,
        children: [
            {
                path: '',
                name: 'reviews',
                component: List,
            },
            {
                path: '/reviews/edit/:id',
                name: 'reviews_edit',
                component: Edit,
                props: true
            },
            {
                path: '/reviews/create',
                name: 'reviews_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/file',
        component: Empty,
        children: [
            {
                path: '',
                name: 'file',
                component: List,
            },
            {
                path: '/file/edit/:id',
                name: 'file_edit',
                component: Edit,
                props: true
            },
            {
                path: '/file/create',
                name: 'file_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/fileCategory',
        component: Empty,
        children: [
            {
                path: '',
                name: 'fileCategory',
                component: List,
            },
            {
                path: '/fileCategory/edit/:id',
                name: 'fileCategory_edit',
                component: Edit,
                props: true
            },
            {
                path: '/fileCategory/create',
                name: 'fileCategory_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/faq',
        component: Empty,
        children: [
            {
                path: '',
                name: 'faq',
                component: List,
            },
            {
                path: '/faq/edit/:id',
                name: 'faq_edit',
                component: Edit,
                props: true
            },
            {
                path: '/faq/create',
                name: 'faq_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/product',
        component: Empty,
        children: [
            {
                path: '',
                name: 'product',
                component: List,
            },
            {
                path: '/product/edit/:id',
                name: 'product_edit',
                component: Edit,
                props: true
            },
            {
                path: '/product/create',
                name: 'product_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/productCategory',
        component: Empty,
        children: [
            {
                path: '',
                name: 'productCategory',
                component: List,
            },
            {
                path: '/productCategory/edit/:id',
                name: 'productCategory_edit',
                component: Edit,
                props: true
            },
            {
                path: '/productCategory/create',
                name: 'productCategory_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/attribute',
        component: Empty,
        children: [
            {
                path: '',
                name: 'attribute',
                component: List,
            },
            {
                path: '/attribute/edit/:id',
                name: 'attribute_edit',
                component: Edit,
                props: true
            },
            {
                path: '/attribute/create',
                name: 'attribute_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/attributeCategory',
        component: Empty,
        children: [
            {
                path: '',
                name: 'attributeCategory',
                component: List,
            },
            {
                path: '/attributeCategory/edit/:id',
                name: 'attributeCategory_edit',
                component: Edit,
                props: true
            },
            {
                path: '/attributeCategory/create',
                name: 'attributeCategory_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/serial',
        component: Empty,
        children: [
            {
                path: '',
                name: 'serial',
                component: List,
            },
            {
                path: '/serial/edit/:id',
                name: 'serial_edit',
                component: Edit,
                props: true
            },
            {
                path: '/serial/create',
                name: 'serial_store',
                component: Edit,
                props: true
            }
        ]
    },
    {
        path: '/country',
        component: Empty,
        children: [
            {
                path: '',
                name: 'country',
                component: List,
            },
            {
                path: '/country/edit/:id',
                name: 'country_edit',
                component: Edit,
                props: true
            },
            {
                path: '/country/create',
                name: 'country_store',
                component: Edit,
                props: true
            }
        ]
    },

    {
        path: '/city',
        component: Empty,
        children: [
            {
                path: '',
                name: 'city',
                component: List,
            },
            {
                path: '/city/edit/:id',
                name: 'city_edit',
                component: Edit,
                props: true
            },
            {
                path: '/city/create',
                name: 'city_store',
                component: Edit,
                props: true
            }
        ]
    },

];

const router = new VueRouter({
    routes: routes,
});

import {store} from './store/store'

Object.defineProperty(Vue.prototype, '$bus', {
    get() {
        return this.$root.bus;
    }
});

let bus = new Vue({});

const admin = new Vue({
    router,
    store,
    el: '#admin',
    components: {
        Home, Edit, List
    },
    data: {
        bus: bus
    }
});
