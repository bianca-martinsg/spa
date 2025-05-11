<template>
    <div class="layout-wrapper">
        <Sidebar :logo="logo" :avatar="avatar" />

        <div v-if="showDrawer" class="backdrop"></div>

        <div class="main-content container">
            <h2 class="title mb-3">Lista de Produtos</h2>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex">
                    <SearchInput v-model="searchQuery" placeholder="Pesquisar produtos" />

                    <button class="btn btn-light filter-button ms-2" aria-label="Filtrar">
                        <i class="bi bi-funnel"></i>
                    </button>
                </div>

                <CustomButton text="Novo Produto" :icon="'bi bi-plus'" customClass="btn-danger"
                    :style="{ backgroundColor: '#DA1E28', color: 'white' }" @click="showDrawer = true" />
            </div>

            <ProductTable :filteredProducts="filteredProducts" />

            <DrawerModal :showDrawer="showDrawer" :logo="logo" @update:showDrawer="showDrawer = $event"
                @save-product="save" />
        </div>
    </div>
</template>

<script>
import Sidebar from './Sidebar.vue';
import CustomButton from './CustomButton.vue';
import SearchInput from './SearchInput.vue';
import DrawerModal from './DrawerModal.vue';
import ProductTable from './ProductTable.vue'; // Importe o novo componente
import axios from 'axios';
import logo from '@assets/logo.png';
import avatar from '@assets/avatar.png';

export default {
    components: {
        Sidebar,
        CustomButton,
        SearchInput,
        DrawerModal,
        ProductTable // Registre o novo componente
    },
    data() {
        return {
            products: [],
            showDrawer: false,
            searchQuery: '',
            logo: logo,
            avatar: avatar
        };
    },
    computed: {
        filteredProducts() {
            return this.products.filter(product =>
                product.name.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        }
    },
    mounted() {
        this.fetchProducts();
    },
    methods: {
        fetchProducts() {
            axios
                .get('/api/products')
                .then((res) => {
                    this.products = res.data.sort((a, b) => b.id - a.id);
                })
                .catch((err) => {
                    console.error('Erro ao obter produtos:', err);
                    alert('Falha ao carregar produtos');
                });
        },

        save(productData) {
            console.log(productData);
            console.log('category:', this.category);

            axios
                .post('/api/products', productData)
                .then(() => {
                    this.fetchProducts();
                    this.showDrawer = false;
                })
                .catch((error) => {
                    console.log('Erro ao salvar o produto', error);
                    alert('Falha ao salvar o produto');
                });
        }
    }
};
</script>

<style scoped>
.container {
    margin-top: 64px;
    padding-left: 0 !important;
}

.layout-wrapper {
    display: flex;
}

.main-content {
    flex-grow: 1;
    margin-left: 64px;
}

.title {
    font-size: 28px;
    line-height: 44px;
    font-weight: 600;
    color: #13171a;
}

.backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(4px);
    z-index: 1000;
}
</style>
