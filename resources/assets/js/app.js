
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



require('./bootstrap');
// import router from './routes';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('chart', require('./components/Chart.vue'));
Vue.component('bar', require('./components/Bar.vue'));
Vue.component('drivers', require('./components/Drivers.vue'));
// Vue.component('logs', require('./components/Logs.vue'));
// Vue.component('reports', require('./components/Reports.vue'));

const app = new Vue({
    el: '#app'
});

// To activate vue router
// const app = new Vue({
//     el: '#app',
//     router
// });




