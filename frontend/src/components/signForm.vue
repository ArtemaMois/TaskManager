<template>
    <form @submit.prevent class="form-box">
        <my-input
            style="padding: 15px 20px; margin-bottom: 24px;"
            v-model="form.login"
            type="name" 
            placeholder="Имя пользователя"
        />
        <my-input 
            style="padding: 15px 20px; margin-bottom: 24px;"
            v-model="form.email"
            type="text" 
            placeholder="Электронная почта"
        />
        <div class="password-wrapper">
            <my-input 
                style="padding: 15px 20px; margin-bottom: 24px;"
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'" 
                placeholder="Пароль"
                class="password-input"
            />
            <my-button type="button" @click="togglePassword" class="password-toggle">
                <span v-if="showPassword">🙈</span>
                <span v-else>👁</span>
            </my-button>
        </div>
        <my-button 
            @click="registerUser" 
            class="signup__btn"
            >Зарегистрироваться
        </my-button>
    </form>
    <my-error class="error-message" v-if="errorMessage"> {{ errorMessage }} </my-error>
</template>

<script> 
import MyButton from '@/components/UI/myButton.vue';
import MyInput from './UI/myInput.vue';
import axios from 'axios';
import { inject } from 'vue';
    export default {
        components: {
            MyButton, MyInput,
        },
        data() {
            return {
                showPassword: false,
                form: {
                    login: '',
                    email: '',
                    password: '',
                },
                errorMessage: '',
                apiDomain: '',
            }
        },
        created() {
            this.apiDomain = inject('apiDomain');
        },
        methods: {
            togglePassword() {
                this.showPassword = !this.showPassword;
            },
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
                    const response = await axios.post(`${this.apiDomain}/api/auth/register`, {
                        login: this.form.login,
                        email: this.form.email,
                        password: this.form.password,
                    });
                    if (response.data.status == "success") {
                        console.log('Успешная регистрация! Можете войти!', response.data);
                        localStorage.setItem("api_token", "Bearer " + response.data.api_token);
                        
                        
                        this.$router.push('/overview');
                    
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
                    } else {
                        this.errorMessage = 'Произошла непредвиденная ошибка!';
                    }
                    console.log(e);  
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
    width: calc(100vh * 0.5);
    height: calc(100vh * 0.5);
    max-width: 500px;
    max-height: 320px;
    border-radius: 10px;
    
}
.form-box input{
    background: #FFFFFF;
    border: 1px solid #DCE4FF;
    width: clamp(343px, 30vw, 400px);
    height: 50px;
    max-width: 400px;
    max-height: 50px;
    outline: none;
}

.signup__btn {
    display: flex;
    max-width: 272px;
    background-color: #546FFF;
    width: 272px;
    height: 45px;
    font-family: NimbusRegular;
    justify-content: center;
    align-items: center;
    font-size: 75%;
    color: #F5F5F7;
    cursor: pointer;
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
.password-wrapper {
    position: relative;
    width: 100%;
    max-width: 400px;
}

.password-toggle {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
    color: #546FFF;
}
</style>