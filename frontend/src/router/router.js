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
        meta: { requiresAuth: false },
    },
    {
        path: '/task',
        component: TaskPage,
        meta: { requiresAuth: true },
    },
    {
        path: '/mentors',
        component: MentorsPage,
        meta: { requiresAuth: true },
    },
    {
        path: '/settings',
        component: SettingsPage,
        meta: { requiresAuth: true },
    }, 
    {
        path: '/chat',
        component: ChatPage,
        meta: { requiresAuth: true },
    }
]

const router = createRouter({
    routes,
    history: createWebHistory(process.env.BASE_URL)
});

router.beforeEach((to, from, next) => {
    console.log('Переход на:', to.fullPath)
    console.log('Нужна авторизация:', to.meta.requiresAuth)
    console.log('Токен:', localStorage.getItem('token'))
  
    const token = localStorage.getItem('api_token')
    if (to.meta.requiresAuth && (!token || token === '')) {
      console.log('→ Редирект на /')
      next({ path: '/', query: { authError: true } })
    } else {
      next()
    }
  })
  

export default router;