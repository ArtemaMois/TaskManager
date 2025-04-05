<template>
    <form @submit.prevent class="form-box">
        <my-input
            style="padding: 15px 20px; margin-bottom: 24px;"
            v-model="form.login"
            type="name" 
            placeholder="Логин"
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
            @click="signinUser" 
            class="signup__btn"
            >Войти
        </my-button>
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
                showPassword: false,
                form: {
                    login: '',
                    password: '',
                },
                errorMessage: '',
            }
        },
        methods: {
            togglePassword() {
                this.showPassword = !this.showPassword;
            },
            async signinUser() {
                this.errorMessage = '';
                try {
                    const response2 = await axios.post('http://localhost:80/api/auth/login', {
                        login: this.form.login,
                        password: this.form.password,
                    }
                );
                console.log(response2.status);
                    if (response2.data.status == "success") {
                        console.log('Успешный вход!', response2.data.token);
                        localStorage.setItem("api_token", "Bearer " + response2.data.token);
                        this.$router.push('/settings');
                        
                    } else {
                        if (response2.status == "failed") {
                            console.log
                            this.errorMessage = response2.data;
                        }
                    }
                } catch (error) {
                    if (error && error.status === 422) {
                        const errors = error.response2.errors || {};
                        this.errorMessage = errors.login?.[0];
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