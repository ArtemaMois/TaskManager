<template>
    <input :value="modelValue" @input="updateInput" class="input" type="text">
</template>

<script>
export default {
    name: 'my-input',
    props: {
        modelValue: [String, Number]
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
    max-width: 280px;
    border: 1px solid rgba(245, 245, 247, 1);
    border-radius: 10px;
}
</style>