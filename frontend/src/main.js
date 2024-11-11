import { createApp } from 'vue'
import App from '@/App'
import router from '@/router/router'
import MyButton from '@/components/UI/myButton.vue'
import MyInput from '@/components/UI/myInput.vue'
import MyDialog from '@/components/UI/myDialog.vue'
import MySelect from '@/components/UI/mySelect.vue'
import NavBar from '@/components/UI/navBar.vue'
import PostList from '@/components/postList.vue'
import signForm from '@/components/signForm.vue'
import PostItem from '@/components/postItem.vue'
import signupForm from '@/components/signupForm.vue'
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap-vue/dist/bootstrap-vue.css"
import "bootstrap"
const app = createApp(App)



app
    .component('my-button', MyButton)
    .component('my-input', MyInput)
    .component('my-dialog', MyDialog)
    .component('my-select', MySelect)
    .component('nav-bar', NavBar)
    .component('post-list', PostList)
    .component('sign-form', signForm)
    .component('post-item', PostItem)
    .component('signup-form', signupForm)
    .use(router)
    .mount('#app')