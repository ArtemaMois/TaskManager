<template>
    <select :value="modelValue" @change="changeOptions" class="select">
        <option 
            disabled 
            value="">
            Выберите из списка
        </option>
        <option 
            v-for="option in options" 
            :key="option.value" 
            :value="option.value">

            {{ option.name }}
        </option>
    </select>
</template>

<script>
    export default {
        name: 'my-select',
        props: {
            modelValue: {
                type: String
            },
            options: {
                type: Array,
                default: () => []
            }
        },
        methods: {
            changeOptions(event) {
                this.$emit('update:modelValue', event.target.value)
            },
        }
    }
</script>

<style lang="scss" scoped>
.select{
    border: 2px solid black;
    border-radius: 50%
}
</style>