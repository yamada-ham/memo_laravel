import Router from 'vue-router';
import router from './router';
import Vuex from 'vuex';
import store from './store/store.js';
require('./bootstrap');

window.Vue = require('vue');
Vue.use(Router);


Vue.component('main-component', require('./components/MainComponent.vue').default);
// Vue.component('memo-card-component', require('./components/MemoCardComponent.vue').default);
// Vue.component('curd-memo-component', require('./components/CurdMemoComponent.vue').default);


const app = new Vue({
    el: '#app',
    store,
    router
});
