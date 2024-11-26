<template>
    <form @submit.prevent class="form-box">
        <my-input
            style="padding: 5px; margin-bottom: 10px;"
            v-model="form.login"
            type="name" 
            placeholder="Логин"
        />
        <my-input 
            style="padding: 5px; margin-bottom: 10px;"
            v-model="form.password"
            type="password" 
            placeholder="Пароль"
        />
        <my-button :class="'signup__btn'"
            @click="signinUser"
            >Войти
        </my-button>
        <my-button 
            @click="showRegForm" 
            class="signup__btn"
            >Регистрация
        </my-button>
        <my-dialog v-model:show="regVisible" class="dialog-view">
            <div class="reg-box__lable">
                Регистрация
            </div>
            <my-input 
                style="padding: 5px;"
                v-model="form.login"
                type="name" 
                placeholder="Имя"
            />
            <my-input
                style="padding: 5px;"
                v-model="form.email"
                type="email" 
                placeholder="Почта"
            />
            <my-input 
                style="padding: 5px;"
                v-model="form.password"
                type="password" 
                placeholder="Пароль"
            />
            <my-button @click="registerUser" style="justify-content: center; align-items: center; margin-top: 20px; font-size: 85%; max-width: 300px; height: 35px;">
                Зарегестрироваться
            </my-button>
        </my-dialog>
    </form>
    <my-error class="error-message" v-if="errorMessage"> {{ errorMessage }} </my-error>
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
                form: {
                    login: '',
                    email: '',
                    password: '',
                },
                errorMessage: '',
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
            
            async registerUser() {
                try {
                    const response = await axios.post('http://127.0.0.1:88/api/auth/register', {
                        login: this.form.login,
                        email: this.form.email,
                        password: this.form.password
                    });
                    if (response.data.status == "success") {
                        console.log('Успешная регистрация! Можете войти!', response.data);
                        this.$router.push('/');
                    } else {
                        alert('Пройдите регистрацию снова, проверьте данные!');
                    }
                } catch (e) {
                    if (e && e.status === 422) {
                        const errors = e.response.data.errors || {};
                        if (errors.login?.[0]) {
                            this.errorMessage = errors.login?.[0];
                        } else {
                            this.errorMessage = errors.email?.[0];
                        }
                        this.regVisible = true;
                    } else {
                        this.errorMessage = 'Произошла непредвиденная ошибка!';
                    }
                    console.log(e);  
                } 
            },
            async signinUser() {
                this.errorMessage = '';
                try {
                    localStorage.removeItem('xsrfToken');
                    const initCsrf = async () => {
                        await axios.get('http://127.0.0.1:88/api/csrf-cookie', {
                            withCredentials: true,
                        });
                    }
                    initCsrf();
                    const xsrfToken = document.cookie
                    setTimeout(() => {

                    }, 1000);
                    localStorage.setItem('xsrfToken', xsrfToken);
                    const response2 = await axios.post('http://127.0.0.1:88/api/auth/login', {
                        login: this.form.login,
                        password: this.form.password,
                    });
                    if (response2.data.status == "success") {
                        console.log('Успешный вход!', response2.data);
                        this.$router.push('/settings');
                        
                    } else {
                        if (response2.data.status == "failed") {
                            this.errorMessage = response2.data.errors;
                        }
                    }
                } catch (error) {
                    if (error && error.status === 422) {
                        const errors = error.response2.data.errors || {};
                        this.errorMessage = errors.login?.[0];
                        this.regVisible = true;
                    } else {
                        this.errorMessage = 'Произошла непредвиденная ошибка!';
                    }
                    console.log(error);                    
                }
            },
        },
    }
</script>

<style lang="scss">
#app {
    justify-content: center;
    position: relative;
}

.form-box{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: #F5F5F7;
    width: calc(100vh * 0.5);
    height: calc(100vh * 0.5);
    max-width: 500px;
    max-height: 300px;
    border-radius: 10px;
    
}
.input {
    max-height: 30px;
}
.signup__btn {
    display: flex;
    margin-top: 10px;
    max-width: 200px;
    background-color: #546FFF;
    width: 50%;
    height: 30px;
    justify-content: center;
    align-items: center;
    font-size: 75%;
    background: #546FFF;
}
.dialog-view{
    margin: auto;
}
.reg-box__lable{
    display: flex;
    justify-content: center;
    font-family: Square;
    font-size: 120%;
    margin-bottom: 20px;
    max-height: 20px;
}

</style>