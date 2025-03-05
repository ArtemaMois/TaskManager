import AuthPage from "@/pages/AuthPage.vue";
import OverPage from "@/pages/OverPage.vue";
import TaskPage from "@/pages/TaskPage.vue";
import SettingsPage from "@/pages/SettingsPage.vue";
import { createRouter, createWebHistory } from 'vue-router';
import ChatPage from "@/pages/ChatPage.vue";
import MentorsPage from "@/pages/MentorsPage.vue";
const routes = [{
        path: '/',
        component: AuthPage,
       
    },
    {
        path: '/overview',
        component: OverPage,
    },
    {
        path: '/task',
        component: TaskPage,
    },
    {
        path: '/mentors',
        component: MentorsPage,
    },
    {
        path: '/settings',
        component: SettingsPage,
    }, 
    {
        path: '/chat',
        component: ChatPage
    }
]

const router = createRouter({
    routes,
    history: createWebHistory(process.env.BASE_URL)
})

export default router;