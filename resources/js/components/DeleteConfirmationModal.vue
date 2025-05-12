<template>
    <div v-if="showModal" class="modal-backdrop">
        <div class="modal-content">
            <h5 class="modal-title">Confirmar Exclusão</h5>
            <p>Tem certeza de que deseja excluir este produto?</p>
            <div class="modal-actions">
                <button @click="confirmDelete" class="btn btn-danger">Sim, excluir</button>
                <button @click="cancelDelete" class="btn btn-secondary">Cancelar</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
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
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    width: 300px;
    text-align: center;
}

.modal-actions button {
    margin: 10px;
}
</style>