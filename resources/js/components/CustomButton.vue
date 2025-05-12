<template>
    <button :class="['btn', 'custom-button', customClass, icon ? 'd-flex align-items-center' : '']"
        :style="{ ...style, fontSize: '12px' }" :aria-label="ariaLabel" @click="$emit('click')">
        <template v-if="icon">
            <i :class="icon" style="margin-right: 8px;"></i>
        </template>
        {{ text }}
    </button>
</template>

<script>
export default {
    props: {
        text: {
            type: String,
            required: true
        },
        icon: {
            type: String,
            default: ''
        },
        customClass: {
            type: String,
            default: ''
        },
        style: {
            type: Object,
            default: () => ({})
        },
        ariaLabel: {
            type: String,
            default: ''
        }
    }
};
</script>

<style scoped>
.d-flex {
    display: flex;
}

.align-items-center {
    align-items: center;
}

.custom-button {
    padding: 8px 12px;
}

@media (max-width: 768px) {
    .custom-button {
        width: 100%;
        padding: 12px 16px;
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .custom-button i {
        margin-right: 0;
    }

    .custom-button {
        justify-content: center;
    }

    .custom-button span {
        display: none;
    }
}
</style>
