/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
    { path: '/', component: require('./components/Home').default },
    { path: '/cars', component: require('./components/Cars/Index').default },
    { path: '/car/:id/edit', component: require('./components/Cars/Edit').default, props: true },
    { path: '/car/create', component: require('./components/Cars/Create').default },

];
const router = new VueRouter({
    routes,
});

const app = new Vue({
    router
}).$mount('#app');
