require('./bootstrap');

import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router';
import store from './store';
import axios from 'axios';
import VueTheMask from 'vue-the-mask';
import $ from 'jquery';
import 'select2/dist/css/select2.css';
import 'select2';

axios.defaults.baseURL = process.env.VUE_APP_API_URL;

// Fetch user data and then mount the app
store.dispatch('getUser').then(() => {
  createApp(App)
  .use(VueTheMask)
    .use(router)
    .use(store)
    .mount('#app');
});
