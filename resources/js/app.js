import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue'; // Certifique-se de que o caminho para o App.vue esteja correto
import ProductList from './components/ProductList.vue'; // Componente para listagem de produtos
import ProductForm from './components/ProductForm.vue'; // Componente para cadastro de produtos

Vue.use(VueRouter);

const routes = [
  { path: '/produtos', component: ProductList },
  { path: '/produtos/novo', component: ProductForm },
];

const router = new VueRouter({
  routes
});

new Vue({
  el: '#app',
  render: h => h(App),
  router
});
