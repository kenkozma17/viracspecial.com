require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import 'es6-promise/auto';
import axios from 'axios';
import VueAuth from '@websanova/vue-auth';
import VueAxios from 'vue-axios';
import auth from './auth/auth';
import store from './store';
import router from './router';

Vue.router = router;
Vue.use(VueRouter);

// Set Vue authentication
Vue.use(VueAxios, axios);
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`;
Vue.use(VueAuth, auth);

// Set Vue globally
window.Vue = Vue;

let files = require.context('./components', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

const app = new Vue({
    el: '#app',
    store,
    router,
    data: {
        isLoaded: false
    },
    watch: {
        '$route': function(to, from) {
            this.loadPage();
        }
    },
    methods: {
        loadPage() {
            let _this = this;
            this.isLoaded = false;
            setTimeout(function() {
                _this.isLoaded = true;
            }, 2000);
        },
    },
    mounted() {
        this.loadPage();
    }
});