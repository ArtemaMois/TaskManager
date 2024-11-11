<template>
    <div @click="$router.push('/')" class="logo">Сайт</div>
    <div class="navbar">
        <div class="navbar__btns">
            <my-button @click="$router.push('/posts')" class="btns" style="box-shadow: 2px 2px 4px gray;">Пользователи</my-button>
            <my-button @click="$router.push('/about')" class="btns" style="margin-left: 10px; box-shadow: 2px 2px 4px gray;">О сайте</my-button>
        </div>
    </div>
</template>

<script>
    import myButton from '@/components/UI/myButton.vue';
    export default {
        components: {
            myButton,
        }
    }
</script>

<style lang="scss" scoped>
.navbar{
    height: 50px;
    background-color: #ffffff;
    display: flex;
}
.btns{
    width: 120px;
    height: 25px;
}
.navbar__btns{
    margin-left: 50%;
}
.logo{
    max-width: 70px;
    margin-left: 5px;
    margin-top: 10px;
    border: 2px solid black;
    border-radius: 50%;
    display: flex;
    justify-content: center;
}
</style>