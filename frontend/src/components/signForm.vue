<template>
    <form @submit.prevent class="form-box">
        <my-input
            style="padding: 5px; margin-bottom: 10px;"
            v-model="post.login"
            type="name" 
            placeholder="Почта"
        />
        <my-input 
            style="padding: 5px; margin-bottom: 10px;"
            v-model="post.password"
            type="password" 
            placeholder="Пароль"
        />
        
        <my-button :class="'signup__btn'"
            @click="sendUserData"
            >Войти
        </my-button>
        
        <my-button 
            @click="showRegForm" 
            class="signup__btn"
            >Регистрация
        </my-button>
        <my-dialog v-model:show="regVisible">
            <div class="reg-box__lable">
                Регистрация
            </div>
            <my-input 
                style="padding: 5px;"
                v-model="post.login"
                type="name" 
                placeholder="Имя"
            />
            <my-input
                style="padding: 5px;"
                v-model="post.email"
                type="email" 
                placeholder="Почта"
            />
            <my-input 
                style="padding: 5px;"
                v-model="post.password"
                type="password" 
                placeholder="Пароль"
            />
            <my-button @click="sendUserData" style="justify-content: center; align-items: center; margin-top: 20px; font-size: 85%; max-width: 300px; height: 35px;">
                Зарегестрироваться
            </my-button>
        </my-dialog>
    </form>
</template>

<script>
import MyButton from '@/components/UI/myButton.vue';
import MyInput from './UI/myInput.vue';
import axios from 'axios';
    export default {
        components: {
            MyButton, MyInput,
        },
        data() {
            return {
                regVisible: false,
                post: {
                    login: '',
                    email: '',
                    password: '',
                },

            }
        },
        methods: {
            createPost() {
                this.post.id = Date.now();
                this.$emit('create', this.post)
                this.post = {
                    title: '',
                    body: ''
                }
            },
            showRegForm() {
                this.regVisible = true;
            },
            
            async sendUserData() {
                try {
                    const response = await axios.post('http://127.0.0.1:88/api/auth/register', {
                        login: this.post.login,
                        email: this.post.email,
                        password: this.post.password
                    });
                    if (response.data.status == "success") {
                        console.log('Успешный вход!', response.data);
                        localStorage.setItem('token', response.data.token);
                        this.$router.push('/posts');
                    } else {
                        alert('Пользователь не найден! Пройдите регистрацию.');
                        this.regVisible = true;
                    }
                } catch (e) {
                    alert('Ошибка при отправке данных пользователя!');
                    console.error(e);
                    console.error(e.response.data.errors.login);
                    alert('The login has already been taken.')
                } 
            },
            },
    }
</script>

<style lang="scss">
.form-box{
    display: flex;
    justify-content: center;
    align-items: center;
    background: #F5F5F7;
    width: calc(100vh * 0.5);
    height: calc(100vh * 0.5);
    max-width: 300px;
    max-height: 200px;
    border-radius: 10px;
    
}
.reg-box__lable{
    display: flex;
    justify-content: center;
    font-family: Square;
    font-size: 120%;
    margin-bottom: 20px;
}
</style>