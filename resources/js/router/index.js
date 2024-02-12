import {createRouter, createWebHistory} from 'vue-router'


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import('../pages/Home.vue')
        },
        {
            path: '/favorites',
            name: 'favorites',
            component: () => import('../pages/Favorites.vue')
        },
    ]
})

export default router
