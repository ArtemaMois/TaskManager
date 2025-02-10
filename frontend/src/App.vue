<template>
    <router-view></router-view>
</template>

<script>
export default {
}
</script>

<style >
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
html,
body {
    height: 100%;
}

*::-webkit-scrollbar-thumb {
    border-radius: 20px;
}
#app {
    min-height: 100%;
    display: flex;
    flex-direction: column;
    max-width: 1640px;
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

/** Plus Jakarta Sans */

@font-face {
    font-family: 'JakartaSansExtraLight';
    src: url('~@/assets/fonts/chat/plus_jakarta_sans/PlusJakartaSans-ExtraLight.woff2');
    font-weight: 200;
}

@font-face {
    font-family: 'JakartaSansLight';
    src: url('~@/assets/fonts/chat/plus_jakarta_sans/PlusJakartaSans-Light.woff2');
    font-weight: 300;
}

@font-face {
    font-family: 'JakartaSansRegular';
    src: url('~@/assets/fonts/chat/plus_jakarta_sans/PlusJakartaSans-Regular.woff2');
    font-weight: 400;
}

@font-face {
    font-family: 'JakartaSansMedium';
    src: url('~@/assets/fonts/chat/plus_jakarta_sans/PlusJakartaSans-Medium.woff2');
    font-weight: 500;
}

@font-face {
    font-family: 'JakartaSansSemiBold';
    src: url('~@/assets/fonts/chat/plus_jakarta_sans/PlusJakartaSans-SemiBold.woff2');
    font-weight: 600;
}

@font-face {
    font-family: 'JakartaSansBold';
    src: url('~@/assets/fonts/chat/plus_jakarta_sans/PlusJakartaSans-Bold.woff2');
    font-weight: 700;
}

@font-face {
    font-family: 'JakartaSansExtraBold';
    src: url('~@/assets/fonts/chat/plus_jakarta_sans/PlusJakartaSans-ExtraBold.woff2');
    font-weight: 800;
}
</style>