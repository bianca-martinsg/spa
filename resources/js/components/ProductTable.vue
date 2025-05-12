<template>
    <div class="table-scroll">
        <table class="table table-borderless align-middle">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="filteredProducts.length === 0">
                    <td colspan="5" class="text-center">Nenhum produto encontrado</td>
                </tr>
                <tr v-for="(product) in filteredProducts" :key="product.id">
                    <td># {{ product.id }}</td>
                    <td class="text-truncate" style="max-width: 200px;">{{ product.name }}</td>
                    <td>
                        <Badge :category="product.category" />
                    </td>
                    <td>
                        R$ {{
                            parseFloat(product.price).toLocaleString('pt-BR', {
                                minimumFractionDigits: 2
                            })
                        }}
                    </td>
                    <td>
                        <i class="bi bi-pencil-square text-warning" style="cursor: pointer;"
                            @click="$emit('edit-product', product.id)" title="Editar"></i>
                        <i class="bi bi-trash text-danger ms-2" style="cursor: pointer;"
                            @click="openDeleteModal(product.id)" title="Deletar"></i>
                    </td>
                </tr>
            </tbody>
        </table>

        <DeleteConfirmationModal @confirm-delete="handleConfirmDelete" ref="deleteModal" />
    </div>
</template>

<script>
import Badge from './Badge.vue';
import DeleteConfirmationModal from './DeleteConfirmationModal.vue';

export default {
    components: {
        Badge,
        DeleteConfirmationModal,
    },
    props: {
        filteredProducts: Array,
    },
    methods: {
        openDeleteModal(productId) {
            this.$refs.deleteModal.openModal(productId);
        },
        handleConfirmDelete(productId) {
            this.$emit('delete', productId);
        },
    },
};
</script>

<style scoped>
.table th {
    color: #50565B;
    font-weight: 600;
    font-size: 12px;
    line-height: 16px;
}

.table td {
    color: #50565B;
    font-weight: 500;
    font-size: 14px;
    line-height: 20px;
}

.table-scroll {
    max-height: 600px;
    overflow-y: auto;
}

i {
    cursor: pointer;
}
</style>