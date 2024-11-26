<template>
    <div class="radio-lable"> <slot></slot> </div>
    <div class="radio-box">
        <div :class="{ active: modelValue }" class="radio-toggle">
            <span class="radio-toggle__label">{{ label }}</span>
            <div class="radio-toggle__button" 
                @click="toggle"
                :class="{ active: modelValue }">
            </div>
        </div>
        <div :class="{ active: modelValue2 }" class="radio-toggle2">
            <span class="radio-toggle__label2">{{ label2 }}</span>
            <div class="radio-toggle__button2" 
                @click="toggle2"
                :class="{ active: modelValue2 }">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'my-radio',
        props: {
            modelValue: {
                type: Boolean,
                default: true,
            },
            modelValue2: {
                type: Boolean,
                default: false,
            },
            label: {
                type: String,
                default: "24 часа",
            },
            label2: {
                type: String,
                default: "12 часов",
            },
        },
        emits: ["update:modelValue"], 
        methods: {
            toggle() {
                this.$emit("update:modelValue", !this.modelValue);
            },
            toggle2() {
                this.$emit("update:modelValue2", !this.modelValue2);
            },
        },
    };
</script>

<style lang="scss" scoped>
.radio-lable{
    margin: 32px 0 0 32px;
    font-family: NimbusRegular;
    font-size: 14px;
}
.radio-box {
    margin: 16px 0 0 32px;
    display: flex;
    gap: 32px;
    width: 400px;
}
.radio-toggle {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 184px;
    height: 50px;
    font-family: NimbusRegular;
    font-size: 12px;
    border: 1px solid #F5F5F7;
    border-radius: 10px;
    padding: 0 15px 0 20px;
}

.radio-toggle__button {
    position: relative;
    width: 20px;
    height: 20px;
    background-color: #fff;
    border: 2px solid #F5F5F7;
    border-radius: 100px;
    cursor: pointer;
    transition: background-color 0.3s;
}


.radio-toggle__button:hover {
     background-color: #fff;
}

.radio-toggle__button.active {
    position: relative;
    width: 20px;
    height: 20px;
    background-color: #fff;
    border: 4px solid #546FFF;
    border-radius: 100px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.radio-toggle.active {
    border: 1px solid #546FFF;
}

.radio-toggle__label {
    color: #333;
    font-weight: bold;
}


















.radio-toggle2 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 184px;
    height: 50px;
    font-family: NimbusRegular;
    font-size: 12px;
    border: 1px solid #F5F5F7;
    border-radius: 10px;
    padding: 0 15px 0 20px;
}

.radio-toggle__button2 {
    position: relative;
    width: 20px;
    height: 20px;
    background-color: #fff;
    border: 2px solid #F5F5F7;
    border-radius: 100px;
    cursor: pointer;
    transition: background-color 0.3s;
}


.radio-toggle__button2:hover {
     background-color: #fff;
}

.radio-toggle__button2.active2 {
    position: relative;
    width: 20px;
    height: 20px;
    background-color: #fff;
    border: 4px solid #546FFF;
    border-radius: 100px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.radio-toggle2.active2 {
    border: 1px solid #546FFF;
}

.radio-toggle__label2 {
    color: #333;
    font-weight: bold;
}
</style>