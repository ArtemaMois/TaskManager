<template>
    <div class="custom-select">
        <div
            class="custom-select__header"
            @click="toggleDropdown">
            <span>{{ selectedLabel }}</span>
            <svg class="arrow" :class="{ open: isOpen }" width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.5 0.833009L9 8.33301L16.5 0.833009" stroke="#141522" stroke-width="1.5" stroke-linecap="round"/>
            </svg>

        </div>
        <ul v-if="isOpen" class="custom-select__dropdown">
            <li
                v-for="(option, index) in options"
                :key="index"
                class="custom-select__option"
                :class="{ selected: option.value === modelValue }"
                @click="selectOption(option)"
            >
                {{ option.label }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'my-select',
        props: {
            modelValue: [String, Number],
            options: {
                type: Array,
                required: true,
                default: () => [],
            },
        },
        emits: ["update:modelValue"],

        data() {
            return {
                isOpen: false,
            };
        },
        computed: {
            selectedLabel() {
            const selectedOption = this.options.find(
                (option) => option.value === this.modelValue
            );
            return selectedOption ? selectedOption.label : "Выберите...";
            },
        },
        methods: {
            toggleDropdown() {
                this.isOpen = !this.isOpen;
            },
            selectOption(option) {
                this.$emit("update:modelValue", option.value);
                this.isOpen = false;
            },
        },
    };
</script>

<style lang="scss" scoped>
.custom-select {
    position: relative;
    font-family: Arial, sans-serif;
}

.custom-select__header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border: 1px solid #F5F5F7;
    border-radius: 10px;
    cursor: pointer;
    background-color: #fff;
    height: 50px;
}
.custom-select__header .arrow {
    width: 15px;
    height: 7.5px;
    margin-right: 20px;
    transition: transform 0.1s;
}
.custom-select__header span {
    margin-left: 20px;
    font-family: NimbusRegular;
    font-size: 12px;
    color: #141522;
}

.custom-select__header .arrow.open {
    transform: rotate(180deg);
}

.custom-select__dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    max-width: 400px;
    width: 100%;
    margin: 0;
    padding: 0;
    list-style: none;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #fff;
    z-index: 10;
}

.custom-select__option {
    height: 50px;
    font-family: NimbusRegular;
    display: flex;
    align-items: center;
    font-size: 12px;
    padding: 10px;
    color: #141522;
    cursor: pointer;
    transition: background-color 0.2s;
}

.custom-select__option:hover {
    background-color: #f0f0f0;
}

.custom-select__option.selected {
    font-weight: bold;
}

</style>