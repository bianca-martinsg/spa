<template>
    <div v-if="visible" class="toast show" :class="`toast-${type}`" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="toast-body">
            <i v-if="type === 'success'" class="bi bi-check-circle me-2"></i>
            <i v-if="type === 'error'" class="bi bi-x-circle me-2"></i>
            {{ message }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        message: String,
        type: {
            type: String,
            default: 'success',
        },
    },
    data() {
        return {
            visible: false,
        };
    },
    watch: {
        message(newMessage) {
            if (newMessage) {
                this.showToast(newMessage);
            }
        },
    },
    methods: {
        showToast(msg) {
            this.visible = true;
            setTimeout(() => {
                this.visible = false;
            }, 3000);
        },
    },
};
</script>

<style scoped>
.toast {
    position: fixed;
    top: 20px;
    right: 20px;
    min-width: 200px;
    z-index: 1050;
    border-radius: 8px;
    color: #fff;
    background-color: #28a745;
    padding: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.toast-error {
    background-color: #dc3545;
}

.toast-body {
    display: flex;
    align-items: center;
    font-size: 16px;
}

.toast-body i {
    font-size: 20px;
}
</style>