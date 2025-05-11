<template>
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
                        <input v-model="price" type="number" class="form-control custom-input" id="price" min="0"
                            step="0.01" required />
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
                        <button type="button" class="btn cancel-btn" @click="closeDrawer">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Inserir Produto</button>
                    </div>
                </form>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        showDrawer: Boolean,
        logo: String
    },
    data() {
        return {
            name: '',
            price: '',
            category: ''
        };
    },
    methods: {
        save() {
            this.$emit('save', { name: this.name, price: this.price, category: this.category });
        },
        closeDrawer() {
            this.$emit('close-drawer');
        }
    }
};
</script>

<style scoped>
/* Mantenha o estilo que já estava no seu arquivo original */
</style>