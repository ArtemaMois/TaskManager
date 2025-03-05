import AuthPage from "@/pages/AuthPage.vue";
import OverPage from "@/pages/OverPage.vue";
import TaskPage from "@/pages/TaskPage.vue";
import SettingsPage from "@/pages/SettingsPage.vue";
import { createRouter, createWebHistory } from 'vue-router';
import ChatPage from "@/pages/ChatPage.vue";
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
        path: '/settings',
        component: settingsPage,
    }
]

const router = createRouter({
    routes,
    history: createWebHistory(process.env.BASE_URL)
})

export default router;