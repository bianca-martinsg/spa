<template>
    <div class="layout-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo text-center mb-4">
                <img :src="logo" alt="Logo" class="img-fluid" />
            </div>

            <button class="nav-button">
                <i class="bi bi-card-list" aria-label="Lista de navegação"></i>
            </button>

            <div class="sidebar-spacer"></div>

            <div class="sidebar-bottom">
                <div class="user-avatar mb-4">
                    <img :src="avatar" alt="Avatar" class="img-fluid" />
                </div>
                <button class="logout-button" aria-label="Sair">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </div>
        </aside>

        <div v-if="showDrawer" class="backdrop"></div>


        <!-- Conteúdo principal -->
        <div class="main-content container">
            <h2 class="mb-3">Lista de Produtos</h2>

            <!-- Pesquisa e Botões alinhados à direita -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Input de Pesquisa com ícone dentro -->
                <div class="d-flex">
                    <div class="input-group" style="max-height: 48px;">
                        <span class="input-group-text" aria-label="Buscar">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control search-input" placeholder="Pesquisar..."
                            aria-label="Pesquisar produtos" />
                    </div>

                    <button class="btn btn-light filter-button ms-2" aria-label="Filtrar">
                        <i class="bi bi-funnel"></i>
                    </button>
                </div>

                <!-- Botão Novo Produto alinhado à direita -->
                <button class="btn" @click="showDrawer = true" style="background-color: #DA1E28; color: white;">
                    <i class="bi bi-plus" style="margin-right: 8px;"></i> Novo Produto
                </button>
            </div>

            <table class="table table-borderless align-middle">
                <thead>
                    <tr>
                        <th scope="col">
                            ID <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                        <th scope="col">
                            Nome <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                        <th scope="col">
                            Categoria <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                        <th scope="col">
                            Preço <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, index) in products" :key="product.id">
                        <td>#{{ index + 1 }}</td>
                        <td class="text-truncate" style="max-width: 200px;">{{ product.name }}</td>
                        <td>
                            <span class="badge" :class="badgeClass(product.category || 'Outros')">
                                {{ product.category || 'Outros' }}
                            </span>
                        </td>

                        <td>R$ {{ parseFloat(product.price).toLocaleString('pt-BR', { minimumFractionDigits: 2 }) }}
                        </td>
                    </tr>
                </tbody>
            </table>


            <!-- Drawer Modal -->
            <transition name="slide">
                <div class="drawer" v-if="showDrawer">
                    <div class="drawer-header d-flex flex-column align-items-start">
                        <img :src="logo" alt="Logo" style="width: 40px; margin-bottom: 32px;" />
                        <h5 class="drawer-title mb-0">Cadastrar Produto</h5>
                    </div>

                    <div class="drawer-body">
                        <form @submit.prevent="save">
                            <div class="mb-3">
                                <label for="name" class="custom-label">Nome</label>
                                <input v-model="name" class="form-control custom-input" id="name" required />
                            </div>

                            <div class="mb-3">
                                <label for="price" class="custom-label">Preço</label>
                                <input v-model="price" type="number" class="form-control custom-input" id="price"
                                    min="0" step="0.01" required />
                            </div>

                            <div class="mb-3">
                                <label for="category" class="custom-label">Categoria</label>
                                <select v-model="category" id="category" class="form-select custom-input" required>
                                    <option disabled value="">--</option>
                                    <option>Informática</option>
                                    <option>TV/Áudio</option>
                                    <option>Eletrodomésticos</option>
                                    <option>Peças e Acessórios</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end gap-3">
                                <button type="button" class="btn cancel-btn"
                                    @click="showDrawer = false">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Inserir Produto</button>
                            </div>
                        </form>

                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import logo from '@assets/logo.png';
import avatar from '@assets/avatar.png';

export default {
    data() {
        return {
            products: [],
            showDrawer: false,
            name: 'Nome do Produto',
            price: 'R$ 0,00',
            category: '',
            logo: logo,
            avatar: avatar
        };
    },
    mounted() {
        this.fetchProducts();
    },
    methods: {
        fetchProducts() {
            axios.get('/api/products')
                .then(res => this.products = res.data)
                .catch(err => {
                    console.error('Erro ao obter produtos:', err);
                    alert('Falha ao carregar produtos');
                });
        },
        save() {
            axios.post('/api/products', {
                name: this.name,
                price: this.price,
                category: this.category
            })
                .then(() => {
                    this.fetchProducts();
                    this.showDrawer = false;
                    this.name = '';
                    this.price = '';
                    this.category = '';
                })
                .catch(error => {
                    console.log('Erro ao salvar o produto', error);
                    alert('Falha ao salvar o produto');
                });
        },
        badgeClass(category) {
            console.log(category);
            switch (category) {
                case 'Informática':
                    return 'bg-warning text-dark';
                case 'TV/Áudio':
                    return 'bg-info text-white';
                case 'Eletrodomésticos':
                    return 'bg-primary text-white';
                case 'Peças e Acessórios':
                    return 'bg-danger text-white';
                case 'Outros':
                default:
                    console.log('Outros');
                    return 'bg-secondary text-white';
            }
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
    /* border: 1px solid #ced4da; */
}

.input-group span {
    border-right: none !important;
}

.filter-button {
    background-color: white;
    border: 1px solid #ced4da;
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
    left: 0;
    width: 50%;
    height: 100%;
    background-color: #F0ECE4;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
    z-index: 2000;
    padding: 48px 32px;
    overflow-y: auto;
    max-width: 440px;
}

.slide-enter-active,
.slide-leave-active {
    transition: transform 0.3s ease;
}

.slide-enter,
.slide-leave-to {
    transform: translateX(-100%);
}

.table td {
    vertical-align: middle;
}

.custom-label {
    font-weight: 500;
    /* Medium */
    font-size: 14px;
    line-height: 18px;
    color: #13171A;
}

.custom-input {
    font-size: 12px !important;
}

.cancel-btn {
    border: 1px solid #50565B;
    background-color: transparent;
    color: #50565B;
}

.drawer-title {
    font-size: 36px;
    line-height: 44px;
    font-weight: 600;
    /* semibold */
    color: #13171A;
}

/* Camada de fundo embaçada */
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
