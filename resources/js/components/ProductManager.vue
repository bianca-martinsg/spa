<template>
    <div class="layout-wrapper">
        <Sidebar :logo="logo" :avatar="avatar" />

        <div v-if="showDrawer" class="backdrop"></div>

        <div class="main-content container">
            <h2 class="title mb-3">Lista de Produtos</h2>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex">
                    <SearchInput v-model="searchQuery" placeholder="Pesquisar" />
                    <FilterButton :isFiltersApplied="isFiltersApplied" @toggle-filter="showFilterModal = true" />
                </div>

                <CustomButton text="Novo Produto" icon="bi bi-plus" customClass="btn-danger"
                    :style="{ backgroundColor: '#DA1E28', color: 'white' }" @click="openNewProductDrawer" />
            </div>

            <ProductTable :filteredProducts="filteredProducts" @delete="deleteProduct" @edit-product="editProduct" />

            <DrawerModal :showDrawer="showDrawer" :logo="logo" :productBeingEdited="productBeingEdited"
                @update:showDrawer="showDrawer = $event" @save-product="createProduct"
                @update-product="updateProduct" />

            <FilterModal :show="showFilterModal" :filters="filters" @close="showFilterModal = false"
                @apply="filters = $event" />

            <Toast :message="toastMessage" :type="toastType" />
        </div>
    </div>
</template>

<script>
import Sidebar from './Sidebar.vue';
import CustomButton from './CustomButton.vue';
import SearchInput from './SearchInput.vue';
import DrawerModal from './DrawerModal.vue';
import ProductTable from './ProductTable.vue';
import FilterModal from './FilterModal.vue';
import FilterButton from './FilterButton.vue';
import Toast from './Toast.vue';
import axios from 'axios';
import logo from '@assets/logo.png';
import avatar from '@assets/avatar.png';

export default {
    components: {
        Sidebar,
        CustomButton,
        SearchInput,
        DrawerModal,
        ProductTable,
        FilterModal,
        FilterButton,
        Toast
    },
    data() {
        return {
            products: [],
            showDrawer: false,
            showFilterModal: false,
            searchQuery: '',
            logo,
            avatar,
            filters: {
                category: null,
                minPrice: null,
                maxPrice: null
            },
            toastMessage: '',
            toastType: 'success',
            productBeingEdited: null
        };
    },
    computed: {
        filteredProducts() {
            return this.products.filter(product => {
                const matchesSearch = product.name.toLowerCase().includes(this.searchQuery.toLowerCase());
                const matchesCategory = this.filters.category ? product.category === this.filters.category : true;
                const matchesMin = this.filters.minPrice !== null ? product.price >= this.filters.minPrice : true;
                const matchesMax = this.filters.maxPrice !== null ? product.price <= this.filters.maxPrice : true;
                return matchesSearch && matchesCategory && matchesMin && matchesMax;
            });
        },
        isFiltersApplied() {
            return (
                this.filters.category !== null ||
                this.filters.minPrice !== null ||
                this.filters.maxPrice !== null
            );
        }
    },
    mounted() {
        this.fetchProducts();
    },
    methods: {
        openNewProductDrawer() {
            this.productBeingEdited = null;
            this.showDrawer = true;
        },

        editProduct(id) {
            // Open the drawer modal to edit the product
            const product = this.products.find(p => p.id === id);
            if (product) {
                this.productBeingEdited = { ...product };
                this.showDrawer = true;
            }
        },

        fetchProducts() {
            axios.get('/api/products')
                .then(res => {
                    this.products = res.data.sort((a, b) => b.id - a.id);
                })
                .catch(err => {
                    console.error('Erro ao carregar produtos', err);
                    alert('Falha ao carregar produtos');
                });
        },

        createProduct(productData) {
            axios.post('/api/products', productData)
                .then(() => {
                    this.fetchProducts();
                    this.toastMessage = 'Produto salvo com sucesso!';
                    this.toastType = 'success';
                })
                .catch(error => {
                    console.error('Erro ao salvar produto', error);
                    this.toastMessage = 'Falha ao salvar o produto';
                    this.toastType = 'error';
                })
                .finally(() => {
                    this.showDrawer = false;
                });
        },

        updateProduct(updatedProduct) {
            axios.put(`/api/products/${updatedProduct.id}`, updatedProduct)
                .then(() => {
                    this.fetchProducts();
                    this.toastMessage = 'Produto atualizado com sucesso!';
                    this.toastType = 'success';
                })
                .catch(error => {
                    console.error('Error updating product', error);
                    this.toastMessage = 'Falha ao atualizar o produto';
                    this.toastType = 'error';
                })
                .finally(() => {
                    this.showDrawer = false;
                    this.productBeingEdited = null;
                });
        },


        deleteProduct(id) {
            axios.delete(`/api/products/${id}`)
                .then(() => {
                    this.fetchProducts();
                    this.toastMessage = 'Produto deletado com sucesso!';
                    this.toastType = 'success';
                })
                .catch(error => {
                    console.error('Error deleting product', error);
                    this.toastMessage = 'Falha ao deletar o produto';
                    this.toastType = 'error';
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

@media (max-width: 768px) {
    .main-content {
        margin-left: 0;
        padding: 0 16px;
    }

    .d-flex.justify-content-between {
        flex-direction: column;
        align-items: stretch !important;
        gap: 12px;
    }

    .filter-button,
    .btn-danger {
        width: 100%;
    }

    .title {
        font-size: 22px;
        text-align: center;
    }
}
</style>
