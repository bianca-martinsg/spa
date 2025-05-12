<template>
    <div class="input-group">
        <span class="input-group-text" aria-label="Buscar">
            <i class="bi bi-search"></i>
        </span>
        <input type="text" class="form-control search-input" :placeholder="placeholder" :value="value"
            @input="$emit('input', $event.target.value)" aria-label="Campo de pesquisa" />
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: String,
            default: ''
        },
        placeholder: {
            type: String,
            default: 'Pesquisar...'
        }
    }
};
</script>

<style scoped>
.input-group {
    min-width: 320px;
}

.input-group-text {
    background-color: #ffffff;
    font-size: 12px;
}

.input-group-text i {
    font-size: 12px;
}

.search-input {
    font-size: 12px;
}

span {
    border-right: none;
}
</style>
