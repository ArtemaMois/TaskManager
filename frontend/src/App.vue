<template>
        <router-view></router-view>
</template>

<script>
    export default {
       
    }
</script>

<style lang="scss">
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
html, body {
height: 100%;
}
#app {
    min-height: 100%;
    display: flex;
    flex-direction: column;
    max-width: 1440px;
    margin: auto;
}

.main-class {
    flex: 1 1 auto;
}



@font-face {
    font-family: Square;
    src: url('~@/assets/fonts/bf4548faa85fa5f642f192e6b07ac814.otf');
}
@font-face {
    font-family: Limes;
    src: url('~@/assets/fonts/TTLimesSlab-Regular.otf');
}
@font-face {
    font-family: NimbusBold;
    src: url('~@/assets/fonts/Nimbus/NimbusSanL-Bol.otf');
}
@font-face {
    font-family: NimbusRegular;
    src: url('~@/assets/fonts/Nimbus/NimbusSanL-Reg.otf');
}
</style>