<template>
    <div class="navbar-wrapper">
        <div @click="$router.push('/')" class="logo-view">
            <svg width="34px" height="34px" viewBox="0 0 34 34" fill="black" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.9834 0.333252H10.0167C3.95004 0.333252 0.333374 3.94992 0.333374 10.0166V23.9666C0.333374 30.0499 3.95004 33.6666 10.0167 33.6666H23.9667C30.0334 33.6666 33.65 30.0499 33.65 23.9833V10.0166C33.6667 3.94992 30.05 0.333252 23.9834 0.333252ZM16.1667 25.7499C16.1667 26.3499 15.5667 26.7499 15.0167 26.5166C13 25.6499 10.3667 24.8499 8.53337 24.6166L8.21671 24.5833C7.20004 24.4499 6.36671 23.4999 6.36671 22.4666V9.63325C6.36671 8.34992 7.40004 7.39992 8.66671 7.49992C10.75 7.66659 13.8334 8.66658 15.7667 9.76658C16.0334 9.91658 16.1667 10.1999 16.1667 10.4833V25.7499ZM27.6334 22.4499C27.6334 23.4833 26.8 24.4333 25.7834 24.5666L25.4334 24.5999C23.6167 24.8499 21 25.6333 18.9834 26.4833C18.4334 26.7166 17.8334 26.3166 17.8334 25.7166V10.4666C17.8334 10.1666 17.9834 9.88325 18.25 9.73325C20.1834 8.64992 23.2 7.68325 25.25 7.49992H25.3167C26.6 7.49992 27.6334 8.53325 27.6334 9.81659V22.4499Z" fill="#546FFF"/>
            </svg>
            <div class="logo__title" translate="no">SkillBridge</div>
        </div>
        <div class="navbar">
            <div class="navbar__btns">
                <my-button 
                    @click="$router.push(menu_item.path), setActiveButton(menu_item)" 
                    v-for="menu_item in menu" 
                    :key="menu_item.id" 
                    :class="{ active: isActive(menu_item) }"
                    class="btns">
                    <div class="btn__image">
                        <img class="image" 
                            :class="{ active: isActive(menu_item) }" 
                            :src="menu_item.image" 
                            :alt="menu_item.description" 
                            :key="index">
                    {{ menu_item.text }}
                    </div>
                </my-button>
            </div>
        </div>
    </div>

    
</template>

<script>
    import myButton from '@/components/UI/myButton.vue';
    import menu from '@/data/menu.js'
    export default {
        props: {
            modelValue: {
                type: Number,
                default: 0,
            }
        },
        data() {
            return {
                activeButtonId: null,
                menu,
            };
        },
        components: {
            myButton,
        },
        methods: {
            isActive(menu_item) {
                return menu_item && this.activeButtonId === menu_item.id;
            },
            setActiveButton(menu_item) {
                if (menu_item) {
                    this.activeButtonId = menu_item.id;
                    localStorage.setItem('activeButtonId', menu_item.id);
                }
            }
        },
        mounted() {
            const savedActiveButtonId = localStorage.getItem('activeButtonId');
            if (savedActiveButtonId) {
                this.activeButtonId = parseInt(savedActiveButtonId, 10);
            } else {
                this.activeButtonId = this.menu.length > 0 ? this.menu[0].id : null;
            }
        },
        watch: {
            menu(newMenu) {
                if (newMenu && newMenu.length > 0 && this.activeButtonId === null) {
                    const savedActiveButtonId = localStorage.getItem('activeButtonId');
                    this.activeButtonId = savedActiveButtonId 
                        ? parseInt(savedActiveButtonId, 10) 
                        : newMenu[0].id;
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
.navbar-wrapper {
    display: flex;
    flex-direction: column;
    height: 100%;
    max-width: 252px;
}
.navbar{
    background-color: #ffffff;
    display: flex;
}


.btns {
    background-color: white;
    color: #8E92BC;
    width: 100%;
    height: 44px;
    font-family: NimbusRegular;
    

}
.btn__image{
    margin-left: 20px;
    display: flex;
    justify-content: start;
    align-items: center;
    gap: 12px;
}
.image{
    max-width: 20px;
    min-height: 18.5px;
}

.btns.active {
    background-color: #F5F5F7;
    width: 100%;
    height: 44px;
    font-family: NimbusBold;
}
.navbar__btns{
    display: flex;
    flex-direction: column;
    width: 74.6%;
    margin: 60px 0 0 32px;
    gap: 24px;
}
.logo-view{
    display: flex;
    flex-direction: row;
    align-items: center;
    margin: 32px 0 0 32px;
    max-height: 40px;
    width: 74.6%;
}
.logo__title{
    color: black;
    font-family: NimbusBold;
    font-size: 180%;
    margin-left: 1.5px;
}
</style>