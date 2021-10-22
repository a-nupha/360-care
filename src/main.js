import '@babel/polyfill'
import Vue from 'vue';
import store from './store/store';
import './plugins/vuetify'
import App from './App.vue';
import router from './router';
// eslint-disable-next-line import/order
import VueMoment from 'vue-moment';
// import moment from 'moment-timezone'
import 'chart.js'
import 'hchs-vue-charts'
import GlobalDate from './views/GlobalDate.vue'

Vue.use(window.VueCharts)
Vue.component(GlobalDate.name, GlobalDate);

Vue.config.productionTip = false;

new Vue({
  // moment,
  VueMoment,
  store,
  router,
  render: h => h(App),
}).$mount('#app');
