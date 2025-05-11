<template>
  <div>
    <h2>Produtos</h2>
    <ul>
      <li v-for="product in products" :key="product.id">
        {{ product.name }}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      products: []  // Inicializa a lista de produtos vazia
    }
  },
  mounted() {
    console.log('Componente ProductList montado')
    // Quando o componente for montado, faz uma requisição para obter os produtos
    this.fetchProducts()
  },
  methods: {
    fetchProducts() {
      // Fazendo uma requisição GET para a API para buscar os produtos
      console.log('Buscando produtos...')
      axios.get('/api/products')
        .then(response => {
          // Armazena os produtos na variável 'products' ao receber a resposta
          console.log('Produtos recebidos:', response.data)
          this.products = response.data
        })
        .catch(error => {
          console.error('Erro ao obter produtos:', error)
        })
    }
  }
}
</script>
