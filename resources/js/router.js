import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboard from './views/Dashboard';
import Details from './views/Details';
import Search1 from './views/Search/Search1';


Vue.use(VueRouter);

const Details2 = {
    template: '<div>Details {{ $route.params.id }}</div>'
  }



export default new VueRouter({
    mode: 'history',

    routes: [
        {
            path: '/', name: 'home', component: Dashboard,
            meta: { title: 'Dashboard' }
        },
        {
            path: '/dashboard', name: 'home', component: Dashboard,
            meta: { title: 'Dashboard' }
        },
        {
            path: '/Details/:id', name: 'Details', component: Details, props:true,
            
        },
        {
            path: '/Search1', name: 'search1', component: Search1,           
        },
    ]

});