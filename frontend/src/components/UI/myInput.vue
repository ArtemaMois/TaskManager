<template>
    <input :value="modelValue" @input="updateInput" class="input" type="text" :placeholder="placeholder">
</template>

<script>
export default {
    name: 'my-input',
    props: {
        modelValue: [String, Number],
        placeholder: {
            type: String,
            required: false
        }
    },
    methods: {
        updateInput(event) {
            this.$emit('update:modelValue', event.target.value)
        }
    }
}
</script>

<style lang="scss" scoped>
.input {
    width: 100%;
    border: 1px solid #DCE4FF;
    border-radius: 10px;
}
</style>