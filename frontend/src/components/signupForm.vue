<template>
    <section class="signup-view">
        <form class="ui form">
            <my-input></my-input>
        </form>
    </section>
</template>

<script>
    export default {
        name: 'sign-form',
    }
</script>

<style lang="scss" >
.signup-view {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}
.form {
  width: 500px;
  min-width: 300px;
}
</style>