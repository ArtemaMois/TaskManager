<template>
    <div class="logo">
        <svg width="34px" height="34" viewBox="0 0 34 34" fill="black" xmlns="http://www.w3.org/2000/svg">
            <path d="M23.9834 0.333252H10.0167C3.95004 0.333252 0.333374 3.94992 0.333374 10.0166V23.9666C0.333374 30.0499 3.95004 33.6666 10.0167 33.6666H23.9667C30.0334 33.6666 33.65 30.0499 33.65 23.9833V10.0166C33.6667 3.94992 30.05 0.333252 23.9834 0.333252ZM16.1667 25.7499C16.1667 26.3499 15.5667 26.7499 15.0167 26.5166C13 25.6499 10.3667 24.8499 8.53337 24.6166L8.21671 24.5833C7.20004 24.4499 6.36671 23.4999 6.36671 22.4666V9.63325C6.36671 8.34992 7.40004 7.39992 8.66671 7.49992C10.75 7.66659 13.8334 8.66658 15.7667 9.76658C16.0334 9.91658 16.1667 10.1999 16.1667 10.4833V25.7499ZM27.6334 22.4499C27.6334 23.4833 26.8 24.4333 25.7834 24.5666L25.4334 24.5999C23.6167 24.8499 21 25.6333 18.9834 26.4833C18.4334 26.7166 17.8334 26.3166 17.8334 25.7166V10.4666C17.8334 10.1666 17.9834 9.88325 18.25 9.73325C20.1834 8.64992 23.2 7.68325 25.25 7.49992H25.3167C26.6 7.49992 27.6334 8.53325 27.6334 9.81659V22.4499Z" fill="#546FFF"/>
        </svg>
        DNX
    </div>
    
    <div class="signup-wrapper">
        <div class="signup-register-text">
            {{ isRegistered ? 'Авторизация' : 'Регистрация' }}
        </div>
        <div class="signup__bar">
            <div class="signup__btns">
                <signin-form v-if="isRegistered" />
                <sign-form v-else />
            </div>
        </div>
        <my-error class="error-message" v-if="showError">Нет доступа!</my-error>

    </div>    
</template>

<script>
    import signForm from '@/components/signForm.vue';
    import signinForm from '@/components/signinForm.vue';
    export default {
        components: {
            signForm,
            signinForm,
        },
        data() {
            return {
                isRegistered: false,
                showError: false,
            };
        },
        methods: {
            
        },
        mounted() {
            document.body.style.backgroundColor = "#F9F9FE";
            const token = localStorage.getItem("api_token");
            this.isRegistered = !!token;
            if (this.$route.query.authError) {
                this.showError = true;
            }
        },
        beforeUnmount() {
            document.body.style.backgroundColor = "";
        }
    }
</script>

<style lang="scss" scoped>

.signup-wrapper{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
}
.signup__bar{
    display: flex;
    justify-content: center;
    max-height: 300px;
}
.logo {
    display: flex;
    position: absolute;
    align-items: center;
    font-size: 32px;
    font-family: NimbusRegular;
    font-weight: 600;
    gap: 12px;
    top: 35px; 
    left: 35px;
}
.signup-register-text {
    font-size: 32px;
    font-family: NimbusRegular;
    font-weight: 600;
}
.logo-view{
    display: flex;
    flex-direction: row;
    justify-content: center;
    margin-bottom: 20px;
    max-height: 50px;
}
.logo__title{
    color: black;
    font-family: Square;
    font-weight: 400;
    font-size: 180%;
    margin-left: 1.5px;
    display: flex;
    align-items: end;
}
.error-view{
    position: absolute;
    max-height: 50px;
}
.error-message {
    display: flex;
    justify-content: center;
    width: 250px;
}
</style>