<template>
    <div class="mb-3">
        <label :for="id" class="custom-label">{{ label }}</label>
        <select :id="id" class="form-select custom-input" :required="required" :value="value"
            @input="$emit('input', $event.target.value)">
            <option disabled value="">{{ placeholder }}</option>
            <option v-for="option in options" :key="option" :value="option">
                {{ option }}
            </option>
        </select>
    </div>
</template>

<script>
export default {
    props: {
        label: String,
        id: String,
        value: String,
        options: Array,
        placeholder: String,
        required: Boolean
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
