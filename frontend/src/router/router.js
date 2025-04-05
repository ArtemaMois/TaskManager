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
        meta: { reqiresAuth: true },
    },
    {
        path: '/task',
        component: TaskPage,
        meta: { reqiresAuth: true },
    },
    {
        path: '/mentors',
        component: MentorsPage,
        meta: { reqiresAuth: true },
    },
    {
        path: '/settings',
        component: SettingsPage,
        meta: { reqiresAuth: true },
    }, 
    {
        path: '/chat',
        component: ChatPage,
        meta: { reqiresAuth: true },
    }
]

const router = createRouter({
    routes,
    history: createWebHistory(process.env.BASE_URL)
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('api_token');
  
    if (to.meta.requiresAuth && !token) {
      next('/');
    } else {
      next();
    }
});

export default router;