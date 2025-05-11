<template>
    <table class="table table-borderless align-middle">
        <thead>
            <tr>
                <th scope="col">ID <i class="bi bi-arrow-down-up ms-1"></i></th>
                <th scope="col">Nome <i class="bi bi-arrow-down-up ms-1"></i></th>
                <th scope="col">Categoria <i class="bi bi-arrow-down-up ms-1"></i></th>
                <th scope="col">Preço <i class="bi bi-arrow-down-up ms-1"></i></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(product, index) in filteredProducts" :key="product.id">
                <td># {{ product.id }}</td>
                <td class="text-truncate" style="max-width: 200px;">{{ product.name }}</td>
                <td>
                    <span class="badge" :class="badgeClass(product.category || 'Outros')">
                        {{ product.category || 'Outros' }}
                    </span>
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
</template>

<script>
export default {
    props: {
        filteredProducts: Array
    },
    methods: {
        badgeClass(category) {
            switch (category) {
                case 'Informática':
                    return 'badge-informatica';
                case 'TV/Áudio':
                    return 'badge-tv-audio';
                case 'Eletrodomésticos':
                    return 'badge-eletrodomesticos';
                case 'Peças e Acessórios':
                    return 'badge-pecas-acessorios';
                case 'Outros':
                default:
                    return 'badge-outros';
            }
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

.badge-informatica {
    background-color: #FEE685;
    color: #A16207;
    padding: 6px 8px;
    border-radius: 4px;
}

.badge-tv-audio {
    background-color: #CEEDF3;
    color: #4094B7;
    padding: 6px 8px;
    border-radius: 4px;
}

.badge-eletrodomesticos {
    background-color: #DDD6FF;
    color: #8E51FF;
    padding: 6px 8px;
    border-radius: 4px;
}

.badge-pecas-acessorios {
    background-color: #FFD6A7;
    color: #CA3500;
    padding: 6px 8px;
    border-radius: 4px;
}

.badge-outros {
    background-color: #6c757d;
    color: white;
    padding: 6px 8px;
    border-radius: 4px;
}
</style>
