<template>
    <div class="mb-3">
        <label :for="id" class="custom-label">{{ label }}</label>
        <input :value="displayValue" @input="onInput" type="text" class="form-control custom-input" :id="id"
            :required="required" :placeholder="placeholder" />
    </div>
</template>

<script>
export default {
    props: {
        id: String,
        label: String,
        value: [String, Number],
        placeholder: String,
        required: {
            type: Boolean,
            default: true
        },
        money: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        displayValue() {
            if (!this.money) return this.value;
            // If the value is null, undefined or empty, return an empty string
            if (this.value === null || this.value === undefined || this.value === '') return '';
            const number = typeof this.value === 'number'
                ? this.value
                : Number(this.value.toString().replace(/\D/g, '')) / 100;

            // Return the value formatted as a currency
            return number.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
        }
    },
    methods: {
        onInput(event) {
            if (!this.money) {
                return this.$emit('input', event.target.value);
            }

            const raw = event.target.value.replace(/\D/g, '');
            const numericValue = Number(raw) / 100;
            this.$emit('input', numericValue);
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
