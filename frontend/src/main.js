import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify';

import VueRouter from 'vue-router';

import Home from './components/Home';
import ListClient from './components/ListClient';
import CreateClient from './components/CreateClient';
import EditClient from './components/EditClient';

Vue.component('Home', Home);
Vue.component('ListClient', ListClient);
Vue.component('CreateClient', CreateClient);
Vue.component('EditClient', EditClient);

Vue.use(VueRouter);

const routes = [
  { path: '/', component: Home },
  { path: '/inicio', component: Home },
  { path: '/clientes', component: ListClient },
  { path: '/criar', component: CreateClient, name: 'CreateClient' },
  { path:'/editar/:id', component:EditClient, name: 'EditClient'}
]

const router = new VueRouter({
  routes,
  mode:'history'
})

Vue.config.productionTip = false

new Vue({
  vuetify,
  router,
  render: h => h(App)
}).$mount('#app')
