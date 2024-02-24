import {createRouter, createWebHistory} from 'vue-router'
import store from '../store/index.js';

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
            component: () => import('../pages/Favorites.vue'),
            meta: {
                middleware: "auth"
            },
        },
        {
            path: '/login',
            name: 'login',
            component: () => import('../pages/Login.vue'),
            meta: {
                middleware: "guest",
                title: `Login`
            }
        },
        {
            path: '/register',
            name: 'register',
            component: () => import('../pages/Register.vue'),
            meta: {
                middleware: "guest",
                title: `register`
            }
        },
    ]
})

router.beforeEach((to, from, next) => {
    if (to.meta.middleware === "guest") {
        if (!store.state.auth.authenticated) {
            next({ name: "home" });
        } else {
            next();
        }
    } else {
        if (store.state.auth.authenticated) {
            next();
        } else {
            next({ name: "login" });
        }
    }
});


export default router
