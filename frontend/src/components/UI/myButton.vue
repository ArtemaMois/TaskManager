<template>
    <button class="btn">
        <slot></slot>
    </button>
</template>

<script>
export default {
    name: 'my-button'
}
</script>

<style lang="scss" scoped>
.btn {
    all: none;
}
.btn {
    display: flex;
    align-items: center;
    border-radius: 10px;
    border: none;
}
.signup__btn{
    justify-content: center;
    align-items: center;
    font-size: 75%;
}
</style>