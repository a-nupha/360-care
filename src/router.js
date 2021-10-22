import Router from 'vue-router';
import Vue from 'vue';
import Scan from './views/Scan.vue';


Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Scan',
      component: Scan,
    },
    {
      path: '/Barnch',
      name: 'Barnch',
      // route level code-splitting
      // this generates a separate chunk (Barnch.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "Barnch" */ './views/Branch.vue'),
    },
  ],
});
