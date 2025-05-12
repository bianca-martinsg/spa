<template>
    <span :class="'badge ' + badgeClass">{{ category || 'Outros' }}</span>
</template>

<script>
export default {
    props: {
        category: String
    },
    computed: {
        badgeClass() {
            const badgeClasses = {
                'Informática': 'badge-informatica',
                'TV/Áudio': 'badge-tv-audio',
                'Eletrodomésticos': 'badge-eletrodomesticos',
                'Peças e Acessórios': 'badge-pecas-acessorios',
                'Outros': 'badge-outros'
            };
            return badgeClasses[this.category] || badgeClasses['Outros'];
        }
    }
};
</script>

<style scoped>
.badge {
    padding: 6px 8px;
    border-radius: 4px;
    font-size: 12px;
    line-height: 16px;
    font-weight: 600;
}

.badge-informatica {
    background-color: #FEE685;
    color: #A16207;
}

.badge-tv-audio {
    background-color: #CEEDF3;
    color: #4094B7;
}

.badge-eletrodomesticos {
    background-color: #DDD6FF;
    color: #8E51FF;
}

.badge-pecas-acessorios {
    background-color: #FFD6A7;
    color: #CA3500;
}

.badge-outros {
    background-color: #6c757d;
    color: white;
}
</style>