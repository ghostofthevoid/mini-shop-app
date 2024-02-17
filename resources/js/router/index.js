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
        {
            path: '/login',
            name: 'login',
            component: () => import('../pages/Login.vue')
        },
        {
            path: '/register',
            name: 'register',
            component: () => import('../pages/Register.vue')
        },
    ]
})

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x-xsrf-token');

    if (!token) {
        if (to.name === 'login' || to.name === 'register') {
            return next()
        } else {
            return next({
                name: 'login'
            })
        }
    }
    if (to.name === 'login' || to.name === 'register' && token) {
        return next({
            name: 'home'
        })
    }

    next()
})
export default router
