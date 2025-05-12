<template>
    <div class="table-scroll">
        <table class="table table-borderless align-middle">
            <thead>
                <tr>
                    <th scope="col">
                        ID
                        <i class="bi bi-arrow-down-up ms-1" @click="sort('id')"></i>
                    </th>
                    <th scope="col">
                        Nome
                        <i class="bi bi-arrow-down-up ms-1" @click="sort('name')"></i>
                    </th>
                    <th scope="col">
                        Categoria
                        <i class="bi bi-arrow-down-up ms-1" @click="sort('category')"></i>
                    </th>
                    <th scope="col">
                        Preço
                        <i class="bi bi-arrow-down-up ms-1" @click="sort('price')"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="filteredProducts.length === 0">
                    <td colspan="4" class="text-center">Nenhum produto encontrado</td>
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
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import Badge from './Badge.vue';

export default {
    components: {
        Badge
    },
    props: {
        filteredProducts: Array
    },
    data() {
        return {
            sortKey: '', // Key to sort
            sortOrder: 1 // 1 for ascending, -1 for descending
        };
    },
    methods: {
        sort(key) {
            if (this.sortKey === key) { // If the sort key is the same as the key, change the sort order
                this.sortOrder = this.sortOrder * -1;
            } else {
                this.sortKey = key;
                this.sortOrder = 1; // 1 for ascending, -1 for descending
            }
            this.sortProducts();
        },
        sortProducts() {
            const sortedProducts = [...this.filteredProducts];
            sortedProducts.sort((a, b) => {
                if (this.sortKey) {
                    // If the sort key is not empty, sort the products
                    if (this.sortKey === 'price') {
                        return (parseFloat(a[this.sortKey]) - parseFloat(b[this.sortKey])) * this.sortOrder;
                    } else if (typeof a[this.sortKey] === 'string') {
                        return a[this.sortKey].localeCompare(b[this.sortKey]) * this.sortOrder;
                    } else {
                        return (a[this.sortKey] - b[this.sortKey]) * this.sortOrder;
                    }
                }
                return 0;
            });

            this.filteredProducts = sortedProducts; // Update the array of products reactively
        }
    }
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

@media (max-width: 768px) {
    .table-scroll {
        overflow-x: auto;
    }

    .table {
        min-width: 600px;
    }

    .table th,
    .table td {
        font-size: 12px;
        padding: 8px;
    }
}
</style>