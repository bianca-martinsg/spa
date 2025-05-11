<template>
    <div class="mb-3">
        <label :for="id" class="custom-label">{{ label }}</label>
        <input :value="value" @input="onInput" :type="type" class="form-control custom-input" :id="id" :min="min"
            :step="step" :required="required" :placeholder="placeholder" />
    </div>
</template>

<script>
export default {
    props: {
        id: String,
        label: String,
        value: [String, Number],
        placeholder: String,
        type: {
            type: String,
            default: 'text'
        },
        min: {
            type: Number,
            default: 0
        },
        step: {
            type: Number,
            default: 0.01
        },
        required: {
            type: Boolean,
            default: true
        }
    },
    methods: {
        onInput(event) {
            const rawValue = event.target.value;
            const value = this.type === 'number' ? Number(rawValue) : rawValue;
            this.$emit('input', value)
        }
    }
};
</script>

<style scoped>
.custom-label {
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;
    color: #13171a;
}

.custom-input {
    font-size: 12px !important;
    padding: 9px;
    border: 1px solid #9FA5AD;
    border-radius: 8px;
}
</style>
