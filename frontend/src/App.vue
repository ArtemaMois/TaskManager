<template>
    <div class="app">
        <nav-bar v-if="$route.path !== '/'" ></nav-bar>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
       
    }
</script>

<style lang="scss">
@import '~bootstrap/dist/css/bootstrap.css';
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background: rgb(255, 255, 255);
}
@font-face {
    font-family: Square;
    src: url('~@/assets/fonts/bf4548faa85fa5f642f192e6b07ac814.otf');
}
</style>