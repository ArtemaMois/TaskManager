<template>
    <div>
        <my-dragdrop></my-dragdrop>
        <div class="general-input-block">
            <div class="general-input-title__login">Информация о пользователе:</div>
            <my-input v-model="login" :placeholder="login" class="general-input__login"></my-input>
            <my-input placeholder="Ваша почта" disabled class="general-input__email"></my-input>
            <my-button @click="loginSet" class="general-input-button">Обновить данные</my-button>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'my-settings-general',
        data() {
            return {
                selected: null,
                login: '',
                options: [
                    {
                        value: 1, label: "English"
                    },
                    {
                        value: 2, label: "Russian"
                    },
                    
                ],
            };
        },
        methods: {
            loginSet() {
                this.login = localStorage.getItem('login');
            }
        }
    };
</script>

<style lang="scss" scoped>
.general-input-block {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin: 32px 0 0 32px;
}
.general-input__login, .general-input__email {
    padding: 8px 15px;
    font-size: 16px;
    max-width: 300px;
    max-height: none;
    border: 2px solid #546FFF;
    border-radius: 10px;
    
}
.general-input-title__login {
    font-family: 'Ubuntu Regular';
    font-size: 16px;
}
.general-input__email {
    opacity: 50%;
    color: black;
}
.general-input-button{
    max-width: 200px;
    height: 50%;
    margin: 32px 0 32px 0px;
    padding: 10px 0 10px 0;
    justify-content: center;
    color: #FFF;
    font-family: 'Ubuntu Medium';
    background-color: #546FFF;
    cursor: pointer;
}

.general-input-button:hover
{
    background-color: #4862f7;
    cursor: pointer;
    transition: all .3s;
}
</style>