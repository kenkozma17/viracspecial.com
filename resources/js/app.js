require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import store from './store';
import routes from './router';

let files = require.context('./components', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

const app = new Vue({
    el: '#app',
    store,
    router: new VueRouter(routes),
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