import AuthPage from "@/pages/AuthPage.vue";
import PostPage from "@/pages/PostPage.vue";
import AboutPage from "@/pages/AboutPage.vue";
import { createRouter, createWebHistory } from 'vue-router';
const routes = [{
        path: '/',
        component: AuthPage,
    },
    {
        path: '/posts',
        component: PostPage,
    },
    {
        path: '/about',
        component: AboutPage,
    }
]

const router = createRouter({
    routes,
    history: createWebHistory(process.env.BASE_URL)
})

export default router;