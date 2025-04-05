<template>
    <transition name="fade">
        <div v-if="isVisible" class="error-box">
            <span class="error-logo">!</span>
            <p class="error"> <slot></slot> </p>
        </div>
    </transition>
</template>

<script>
export default {
    name: 'my-error',
    props: {
        timeout: {
            type: Number,
            default: 5000,
        },
    },
    data() {
        return {
            isVisible: true,
        };
    },
    mounted() {
        setTimeout(() => {
            this.isVisible = false;
        }, this.timeout);
    },
};
</script>

<style lang="scss" scoped>
.error-box {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 40px;
}
.error {
    font-family: NimbusBold;
    display: flex;
    align-items: center;
    max-width: 250px;
    border: 7px solid #546FFF;
    border-radius: 10px;
    color: #000;
    padding: 15px;
}
.error-logo {
    color: #546FFF;
    font-family: NimbusBold;
    font-size: 52px;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>
