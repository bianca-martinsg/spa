<template>
    <div v-if="showModal" class="modal-backdrop">
        <div class="modal-content">
            <h5 class="modal-title">Confirmar Exclusão</h5>
            <p>Tem certeza de que deseja excluir este produto?</p>
            <div class="modal-actions">
                <CustomButton text="Cancelar" customClass="cancel-btn" type="button" @click="cancelDelete" />
                <CustomButton text="Sim, excluir" customClass="btn-danger" @click="confirmDelete" />
            </div>
        </div>
    </div>
</template>

<script>
import CustomButton from './CustomButton.vue';

export default {
    components: {
        CustomButton
    },
    data() {
        return {
            showModal: false,
            productIdToDelete: null,
        };
    },
    methods: {
        openModal(productId) {
            this.productIdToDelete = productId;
            this.showModal = true;
        },
        confirmDelete() {
            this.$emit('confirm-delete', this.productIdToDelete);
            this.showModal = false;
            this.productIdToDelete = null;
        },
        cancelDelete() {
            this.showModal = false;
            this.productIdToDelete = null;
        },
    },
};
</script>

<style scoped>
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #f0ece4;
    padding: 20px;
    border-radius: 8px;
    width: 300px;
    text-align: center;
    font-family: 'Inter', sans-serif;
}

.modal-title {
    font-size: 18px;
    margin-bottom: 10px;
    font-family: 'Inter', sans-serif;
    font-weight: 600;
}
</style>