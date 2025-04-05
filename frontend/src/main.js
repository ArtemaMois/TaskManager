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
import signinForm from '@/components/signinForm.vue'
import PostItem from '@/components/postItem.vue'
import signupForm from '@/components/signupForm.vue'
import myFootMain from '@/components/UI/myFootMain.vue'
import myRunningTask from '@/components/UI/myRunningTask.vue'
import myFootSettings from '@/components/UI/myFootSettings.vue'
import mySettingsGeneral from '@/components/UI/mySettingsGeneral.vue'
import mySettingsNotification from '@/components/UI/mySettingsNotification.vue'
import myInputCheckbox from '@/components/UI/myInputCheckbox.vue'
import axios from 'axios'
import myDragAndDrop from '@/components/UI/myDragAndDrop.vue'
import myInputRadio from '@/components/UI/myInputRadio.vue'
import myError from '@/components/UI/myError.vue'
import myActivitySchedule from '@/components/UI/myActivitySchedule.vue'
import mySliderSmall from '@/components/UI/mySliderSmall.vue'
import myTaskCard from '@/components/UI/myTaskCard.vue'
import mySlider from '@/components/UI/mySlider.vue'
import mySliderTasks from '@/components/UI/mySliderTasks.vue'
import mySliderMentors from '@/components/UI/mySliderMentors.vue'
import mySearch from '@/components/UI/mySearch.vue'


const app = createApp(App)
axios.defaults.baseURL = 'http://localhost:80/api';
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;
axios.defaults.xsrfCookieName = "XSRF-TOKEN";
axios.defaults.xsrfHeaderName = "X-XSRF-TOKEN";



app
    .component('my-button', MyButton)
    .component('my-input', MyInput)
    .component('my-dialog', MyDialog)
    .component('my-select', MySelect)
    .component('nav-bar', NavBar)
    .component('post-list', PostList)
    .component('sign-form', signForm)
    .component('signin-form', signinForm)
    .component('post-item', PostItem)
    .component('signup-form', signupForm)
    .component('my-main-foot', myFootMain)
    .component('my-runing', myRunningTask)
    .component('my-foot-settings', myFootSettings)
    .component('my-settings-general', mySettingsGeneral)
    .component('my-settings-notif', mySettingsNotification)
    .component('my-checkbox', myInputCheckbox)
    .component('my-dragdrop', myDragAndDrop)
    .component('my-radio', myInputRadio)
    .component('my-error', myError)
    .component('my-activity', myActivitySchedule)
    .component('my-sslider', mySliderSmall)
    .component('my-taskcard', myTaskCard)
    .component('my-slider', mySlider)
    .component('my-sliderTask', mySliderTasks)
    .component('my-sliderMentors', mySliderMentors)
    .component('my-search', mySearch)
    .use(router)
    .mount('#app')