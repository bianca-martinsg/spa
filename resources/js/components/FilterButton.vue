<template>
    <button class="btn btn-light filter-button ms-2"
        :class="{ 'btn-primary': isFiltersApplied, 'btn-light': !isFiltersApplied }" aria-label="Filtrar"
        @click="toggleFilter">
        <i :class="isFiltersApplied ? 'bi bi-funnel-fill' : 'bi bi-funnel'"></i>
    </button>
</template>

<script>
export default {
    props: {
        isFiltersApplied: {
            type: Boolean,
            required: true
        }
    },
    methods: {
        toggleFilter() {
            this.$emit('toggle-filter');
        }
    }
};
</script>

<style scoped>
.btn-light {
    background-color: transparent;
    border: 1px solid #DEE2E6;
}
</style>