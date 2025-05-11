<template>
    <div class="input-group" style="max-height: 48px;">
        <span class="input-group-text" aria-label="Buscar" style="border-right: none;">
            <i class="bi bi-search"></i>
        </span>
        <input type="text" class="form-control search-input" :placeholder="placeholder" v-bind="$attrs"
            v-model="internalValue" style="border-left: none;" />
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {
            type: String,
            default: ''
        },
        placeholder: {
            type: String,
            default: 'Pesquisar...'
        }
    },
    data() {
        return {
            internalValue: this.modelValue
        };
    },
    watch: {
        internalValue(newValue) {
            this.$emit('update:modelValue', newValue);
        }
    }
};
</script>

<style scoped>
.input-group-text {
    border-left: none;
    background-color: #ffffff;
    font-size: 12px;
}

.input-group-text input {
    font-size: 12px;
}
</style>
