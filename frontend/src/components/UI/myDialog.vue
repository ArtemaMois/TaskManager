<template>
    <div class="dialog" v-if="show"  @click.stop="hideDialog">
        <div @click.stop class="dialog__content">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'my-dialog',
        props: {
            show: {
                type: Boolean,
                default: false
            }
        },
        methods: {
            hideDialog() {
                this.$emit('update:show', false)
            }
        },
    }
</script>

<style lang="scss" scoped>
.dialog{
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.5);
    position: fixed;
    display: flex;
}
.dialog__content{
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin: auto;
    background: white;
    border-radius: 15px;
    min-height: 50px;
    min-width: 300px;
    max-height: 300px;
    padding: 20px;
}
</style>