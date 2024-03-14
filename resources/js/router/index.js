import {createRouter, createWebHistory} from 'vue-router'


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/home',
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
        {
            path: '/user/profile/:id',
            name: 'profile',
            component: () => import('../pages/Profile.vue')
        },
    ]
})

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token')

    if (!token) {
        if (to.name === 'login' || to.name === 'register' || to.name === 'home') {
            return next()
        } else {
            return next({name: 'login'})
        }
    }

    if (to.name === 'login' || to.name === 'register' && token) {
        return next({name: 'home'})
    }
    next()
})

export default router
