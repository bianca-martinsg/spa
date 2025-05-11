<template>
    <div class="layout-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo text-center mb-4">
                <img :src="logo" alt="Logo" class="img-fluid" />
            </div>

            <button class="nav-button">
                <i class="bi bi-card-list"></i>
            </button>

            <div class="sidebar-spacer"></div>

            <div class="sidebar-bottom">
                <div class="user-avatar mb-4">
                    <img :src="avatar" alt="Avatar" class="img-fluid" />
                </div>
                <button class="logout-button">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </div>
        </aside>

        <!-- Conteúdo principal -->
        <div class="main-content container">
            <h2 class="mb-3">Lista de Produtos</h2>

            <!-- Pesquisa e Botões alinhados à direita -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Input de Pesquisa com ícone dentro -->
                <div class="d-flex">
                    <div class="input-group" style="max-height: 48px;">
                        <span class="input-group-text"
                            style="border-right: none; padding: 10px 16px; border-radius: 8px 0 0 8px; font-size: 16px; height: 48px; display: flex; align-items: center;">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control search-input" placeholder="Pesquisar..."
                            style="border-left: none; padding: 10px 16px; border-radius: 0 8px 8px 0; font-size: 16px; height: 48px;" />
                    </div>

                    <button class="btn btn-light filter-button ms-2"
                        style="padding: 14px; margin-left: 16px; max-height: 48px;">
                        <i class="bi bi-funnel"></i> <!-- Ícone de filtro -->
                    </button>

                </div>

                <!-- Botão Novo Produto alinhado à direita -->
                <button class="btn" @click="showDrawer = true"
                    style="background-color: #DA1E28; color: white; font-size: 16px; line-height: 24px; display: flex; align-items: center; padding: 10px 16px;">
                    <i class="bi bi-plus" style="margin-right: 8px;"></i> Novo Produto
                </button>
            </div>

            <ul class="list-group">
                <li class="list-group-item" v-for="product in products" :key="product.id">
                    {{ product.name }} - R$ {{ product.price }}
                </li>
            </ul>

            <!-- Drawer Modal -->
            <transition name="slide">
                <div class="drawer" v-if="showDrawer">
                    <div class="drawer-header d-flex justify-content-between align-items-center p-3 border-bottom">
                        <h5 class="mb-0">Novo Produto</h5>
                        <button class="btn-close" @click="showDrawer = false"></button>
                    </div>
                    <div class="drawer-body p-3">
                        <form @submit.prevent="save">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome do Produto</label>
                                <input v-model="name" class="form-control" id="name" required />
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Preço</label>
                                <input v-model="price" type="number" class="form-control" id="price" required />
                            </div>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </form>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import logo from '@assets/logo.png';
import avatar from '@assets/avatar.png';

export default {
    data() {
        return {
            products: [],
            showDrawer: false,
            name: '',
            price: '',
            logo: logo,
            avatar: avatar
        }
    },
    mounted() {
        this.fetchProducts()
    },
    methods: {
        fetchProducts() {
            axios.get('/api/products')
                .then(res => this.products = res.data)
                .catch(err => console.error('Erro ao obter produtos:', err))
        },
        save() {
            axios.post('/api/products', {
                name: this.name,
                price: this.price
            }).then(() => {
                this.fetchProducts()
                this.showDrawer = false
                this.name = ''
                this.price = ''
            }).catch(error => {
                console.log('Erro ao salvar o produto', error)
            })
        }
    }
}
</script>

<style scoped>
.container {
    margin-top: 64px;
    padding-left: 0 !important;
}

.layout-wrapper {
    display: flex;
}

.sidebar {
    width: 76px;
    background-color: #F0ECE4;
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 48px 0;
}

.logo img {
    width: 48px;
    height: 48px;
}

.nav-button {
    background-color: #E6E1D6;
    border: none;
    width: 100%;
    text-align: center;
    font-size: 20px;
    color: #50565B;
    padding: 8px 0;
}

.nav-button i {
    color: #50565B;
    font-size: 20px;
    background: transparent;
}

.sidebar-spacer {
    flex-grow: 1;
}

.sidebar-bottom {
    text-align: center;
}

.user-avatar img {
    width: 32px;
    height: 32px;
}

.logout-button {
    background: none;
    border: none;
    color: #50565B;
    font-size: 16px;
    margin-top: 5px;
}

.main-content {
    flex-grow: 1;
    margin-left: 64px;
}

/* Pesquisa e Filtro */
.search-input {
    width: 250px;
}

.input-group .input-group-text {
    background-color: transparent;
    border: 1px solid #ced4da;
}

.filter-button {
    background-color: #f0f0f0;
    border: none;
    padding: 8px;
    color: #50565B;
    font-size: 18px;
}

.filter-button i {
    font-size: 18px;
}

/* Drawer */
.drawer {
    position: fixed;
    top: 0;
    left: 76px;
    width: 50%;
    height: 100%;
    background-color: white;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
    z-index: 1050;
    overflow-y: auto;
}

.slide-enter-active,
.slide-leave-active {
    transition: transform 0.3s ease;
}

.slide-enter,
.slide-leave-to {
    transform: translateX(-100%);
}
</style>
