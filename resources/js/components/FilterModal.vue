<template>
    <div v-if="show" class="modal fade show d-block" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filtrar Produtos</h5>
                    <button type="button" class="btn-close" aria-label="Fechar" @click="$emit('close')"></button>
                </div>

                <div class="modal-body">
                    <CustomSelect v-model="localFilters.category" :label="'Categoria'" :id="'category'"
                        :options="['Informática', 'TV/Áudio', 'Eletrodomésticos', 'Peças e Acessórios']"
                        placeholder="--" />

                    <div class="row mt-3">
                        <div class="col">
                            <CustomInput v-model="localFilters.minPrice" :label="'Preço Mínimo'" :id="'minPrice'"
                                type="number" :min="0" placeholder="R$ 0,00" :money="true" />
                        </div>
                        <div class="col">
                            <CustomInput v-model="localFilters.maxPrice" :label="'Preço Máximo'" :id="'maxPrice'"
                                type="number" :min="0" placeholder="R$ 0,00" :money="true" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <CustomButton text="Limpar filtros" customClass="cancel-btn" type="button" @click="clearFilters" />

                    <div class="d-flex justify-content-end gap-3">
                        <CustomButton text="Cancelar" customClass="cancel-btn" type="button" @click="$emit('close')" />
                        <CustomButton text="Aplicar" customClass="btn-danger" @click="applyFilters" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CustomSelect from './CustomSelect.vue';
import CustomButton from './CustomButton.vue';
import CustomInput from './CustomInput.vue';
export default {
    name: 'FilterModal',
    components: { CustomSelect, CustomButton, CustomInput },
    props: {
        show: Boolean,
        filters: Object
    },
    data() {
        return {
            localFilters: {
                category: null,
                minPrice: null,
                maxPrice: null
            }
        };
    },
    watch: {
        filters: {
            immediate: true,
            handler(val) {
                this.localFilters = { ...val };
            }
        }
    },
    methods: {
        applyFilters() {
            this.$emit('apply', { ...this.localFilters });
            this.$emit('close');
        },
        clearFilters() {
            this.localFilters = {
                category: null,
                minPrice: null,
                maxPrice: null
            };
        }
    }
};
</script>

<style scoped>
.modal {
    background-color: rgba(0, 0, 0, 0.5);
    font-family: 'Inter', sans-serif;
}

.modal-title {
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    font-size: 1.25rem;
}

.modal-content {
    background-color: #f0ece4;
}

@media (max-width: 576px) {
    .modal-dialog {
        margin: 1rem;
        max-width: 100%;
    }

    .modal-body .row {
        flex-direction: column;
    }

    .modal-body .col {
        width: 100%;
        margin-bottom: 12px;
    }

    .modal-footer {
        flex-direction: column;
        gap: 12px;
    }

    .modal-footer>div {
        width: 100%;
        justify-content: space-between;
    }
}
</style>