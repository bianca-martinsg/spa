<template>
    <transition name="slide">
        <div class="drawer" v-if="showDrawer">
            <div class="drawer-header d-flex flex-column align-items-start">
                <img :src="logo" alt="Logo" style="width: 40px; margin-bottom: 12px;" />
                <h5 class="drawer-title">Cadastrar Produto</h5>
            </div>

            <div class="drawer-body">
                <form @submit.prevent="save">
                    <div class="mb-3">
                        <CustomInput v-model="name" :label="'Nome'" :id="'name'" :required="true" placeholder="Nome" />

                    </div>

                    <div class="mb-3">
                        <CustomInput v-model="price" :label="'Preço'" :id="'price'" type="number" :min="0" :step="0.01"
                            :required="true" placeholder="R$ 0,00" />
                    </div>

                    <CustomSelect v-model="category" :label="'Categoria'" :id="'category'"
                        :options="['Informática', 'TV/Áudio', 'Eletrodomésticos', 'Peças e Acessórios']"
                        placeholder="--" :required="true" />


                    <div class="d-flex justify-content-end gap-3">
                        <CustomButton text="Cancelar" customClass="cancel-btn" type="button" @click="closeDrawer" />
                        <CustomButton text="Inserir Produto" customClass="btn-danger" type="submit" />
                    </div>
                </form>
            </div>
        </div>
    </transition>
</template>

<script>
import CustomButton from './CustomButton.vue';
import CustomSelect from './CustomSelect.vue';
import CustomInput from './CustomInput.vue';

export default {
    components: {
        CustomButton,
        CustomSelect,
        CustomInput
    },
    props: {
        showDrawer: Boolean,
        logo: String
    },
    watch: {
        showDrawer(newVal) {
            if (newVal) {
                this.name = '';
                this.price = '';
                this.category = '';
            }
        }
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
            this.$emit('save-product', {
                name: this.name,
                price: this.price,
                category: this.category
            });
            this.closeDrawer();
        },
        closeDrawer() {
            this.$emit('update:showDrawer', false);
        }
    }
};
</script>

<style scoped>
.drawer {
    position: fixed;
    top: 0;
    left: 0;
    width: 50%;
    height: 100%;
    background-color: #f0ece4;
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

.drawer-title {
    font-size: 28px;
    line-height: 44px;
    font-weight: 600;
    color: #13171a;
    margin-bottom: 22px;
}

.custom-label {
    font-weight: 500;
    font-size: 14px;
    line-height: 18px;
    color: #13171a;
}

.custom-input {
    font-size: 12px !important;
}

.cancel-btn {
    border: 1px solid #50565b;
    background-color: transparent;
    color: #50565b;
}

@media (max-width: 768px) {
    .drawer {
        width: 100%;
        max-width: none;
        padding: 32px 20px;
    }

    .drawer-title {
        font-size: 22px;
        line-height: 32px;
        text-align: center;
    }

    .drawer-header {
        align-items: center;
    }

    .d-flex.justify-content-end {
        flex-direction: column;
        align-items: stretch;
        gap: 8px;
    }
}
</style>
