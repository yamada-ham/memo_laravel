import Router from 'vue-router';
import router from './router';
import Vuex from 'vuex';
import store from './store/store.js';
require('./bootstrap');

window.Vue = require('vue');
Vue.use(Router);


Vue.component('main-component', require('./components/MainComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    router
});
