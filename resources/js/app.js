
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// configurate spinner
import {RotateSquare2} from 'vue-loading-spinner';
//
// configure particles js
import VueParticles from 'vue-particles';
Vue.use(VueParticles);
//

// configuration of lazy image
import { VLazyImagePlugin } from "v-lazy-image";
Vue.use(VLazyImagePlugin);
//

// moment configuration starts
import moment from 'moment';
//Parse, validate, manipulate, and display dates and times in JavaScript.

//
import Gate from "./Gate";
//

// use costum event to send HTTP request
window.Fire = new Vue();
// end costum event

// Sweet alert configuration
import swal from 'sweetalert2';
window.swal = swal;

const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.toast = toast;
// swal ends

// Vform configuration starts
import { Form, HasError, AlertError } from 'vform';

window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
// vform configuration ends

// laravel vue pagination
Vue.component('pagination', require('laravel-vue-pagination'));
// pagination config ends

// Vue router configuration starts
import VueRouter from 'vue-router';
Vue.use(VueRouter);

let routes = [
  { path: '/', component: require('./components/Home.vue') },
  { path: '/aboutus', component: require('./components/AboutUs.vue') },
  { path: '/whatwedo', component: require('./components/WhatWeDo.vue') },
  { path: '/home', component: require('./components/Dashboard.vue') },
  { path: '/dashboard', component: require('./components/Dashboard.vue') },
  { path: '/developer', component: require('./components/Developer.vue') },
  { path: '/users', component: require('./components/Users.vue') },
  { path: '/clients', component: require('./components/Costumer.vue') },
  { path: '/media', component: require('./components/Media.vue') },
  { path: '/vacancies', component: require('./components/Vacancies.vue') },
  { path: '/vacancy', component: require('./components/Vacancy.vue') },
  { path: '/vacancy/:id', component: require('./components/VacancySingle.vue') },
  { path: '/post', component: require('./components/Post.vue') },
  { path: '/post/:id', component: require('./components/PostSingleAdmin.vue') },
  { path: '/posts/:id', component: require('./components/PostSingle.vue') },
  { path: '/profile', component: require('./components/Profile.vue') },
  { path: '*', component: require('./components/NotFound.vue') },
];

const router = new VueRouter({
  routes, // short for `routes: routes`
  mode: 'history'
});
// Vue router configuration ends

// Vue Progressbar configuration
import VueProgressBar from 'vue-progressbar';

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '3px'
});
// Vue Progressbar

// Filters start
Vue.filter('upText', function(text){
  return text.charAt(0).toUpperCase() + text.slice(1)
});

Vue.filter('myDate', function(created){
  return moment(created).format('MMMM Do YYYY');
});

Vue.filter('DateS', function(created){
  return moment(created).format('l');
});

Vue.filter('myTime', function(created){
  return moment(created).format('LT');
});

Vue.filter('characters', function(value){
  if (value.length >= 180) {
    return value.substring(0,180) + '...';
  } else {
    return value
  }
});
// Filters end

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component(
   'passport-clients',
   require('./components/passport/Clients.vue')
);

Vue.component(
   'passport-authorized-clients',
   require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
   'passport-personal-access-tokens',
   require('./components/passport/PersonalAccessTokens.vue')
);

Vue.component('editor', require('./components/Editor.vue'));
Vue.component('vacancies', require('./components/VacanciesComponent.vue'));
Vue.component('staff', require('./components/Staff.vue'));


const app = new Vue({
  el: '#app',
  router,
  components: {
    RotateSquare2
  },
  data: {
    search: '',
    active_el: '',
  },
  methods: {
    scrollToTop() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    searchit: _.debounce(() => {
        Fire.$emit('searching');
    },1000),
  }
});

let loader = document.getElementById("loader");
window.addEventListener('load', function () {
  loader.classList.add("display-none");
}, false);
