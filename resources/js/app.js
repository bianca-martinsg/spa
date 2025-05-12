import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';
import ProductManager from './components/ProductManager.vue';
Vue.use(VueRouter);

const routes = [
  { path: '/', component: ProductManager },
];

const router = new VueRouter({
  routes
});

new Vue({
  el: '#app',
  render: h => h(App),
  router
});
