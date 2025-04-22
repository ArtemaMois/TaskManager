import AuthPage from "@/pages/AuthPage.vue";
import OverPage from "@/pages/OverPage.vue";
import TaskPage from "@/pages/TaskPage.vue";
import SettingsPage from "@/pages/SettingsPage.vue";
import { createRouter, createWebHistory } from 'vue-router';
import ChatPage from "@/pages/ChatPage.vue";
import MentorsPage from "@/pages/MentorsPage.vue";
import AdminPage from '@/pages/AdminPage.vue';
import MentorsDetail from "@/pages/MentorsDetail.vue";
import TaskDetail from "@/pages/TaskDetail.vue";

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
    },
    {
        path: '/mentors/:id',
        component: MentorsDetail,
        meta: { requiresAuth: true },
    },
    {
        path: '/tasks/:id',
        component: TaskDetail,
        meta: { requiresAuth: true },
    },
    {
        path: '/admin',
        name: 'AdminPanel',
        component: AdminPage,
        meta: { title: 'Админ-панель - Мой сайт', requiresAuth: true, requiresAdmin: true },
    },
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

    // const token = localStorage.getItem('api_token');
    // if (to.meta.requiresAuth && (!token || token === '')) {
    //     console.log('→ Редирект на /');
    //     next({ path: '/', query: { authError: true } });
    //     return;
    // }

    // if (to.meta.requiresAdmin) {
    //     try {
    //     const response = await axios.get('http://localhost:80/api/user', {
    //         headers: { Authorization: token },
    //     });
    //     console.log('Роль пользователя:', response.data.user.role_id);
    //     if (response.data.status === 'success' && response.data.user.role_id === 3) {
    //         next();
    //     } else {
    //         console.log('→ Редирект на /overview (не админ)');
    //         next({ path: '/overview', query: { accessError: 'admin_required' } });
    //     }
    //     } catch (e) {
    //     console.error('Ошибка при проверке роли:', e);
    //     next({ path: '/overview', query: { accessError: 'admin_required' } });
    //     }
    // } else {
    //     next();
    // }

  })
  

export default router;