import Vue from 'vue';
import router from './router';
import App from './components/App';

import Chartkick from 'vue-chartkick';
import Chart from 'chart.js';

Vue.use(Chartkick.use(Chart));

require('./bootstrap');

const app = new Vue({
    el: '#app',
    
    components: {
        App
    },

    router,

});