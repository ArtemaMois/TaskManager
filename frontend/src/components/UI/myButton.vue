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
    color: rgb(255, 255, 255);
    font-family: Square;
    background: rgba(84, 111, 255);
    border-radius: 10px;
    margin-bottom: 10px;
    border: none;
}
.signup__btn{
    width: 50%;
    height: 30px;
    justify-content: center;
    align-items: center;
    font-size: 75%;
}
</style>