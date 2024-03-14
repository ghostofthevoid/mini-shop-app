<template>
    <header>

        <nav
            class="navbar navbar-expand-lg d-flex justify-content-between position-relative border-bottom border-success">
            <router-link :to="{name: 'home'}">
                <div class="d-flex align-items-center">
                    <img src="/images/store.png" alt="Logo" class="rounded-circle ">
                    <div class="ms-3">
                        <h3 class="text-success fw-bold mt-3 text-uppercase">Vue store</h3>
                        <p class="text-muted mx-3 ">The best store!</p>
                    </div>
                </div>
            </router-link>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navmenu"
                    aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navmenu">
                <ul class=" d-flex align-items-center  py-3 navbar-nav ms-auto">
                    <li v-if="token"  @click="()=>emit('openDrawer')"
                        class="d-flex align-items-center me-5 text-secondary nav-item li-cart">
                        <i class="fas fa-shopping-cart me-1"></i>
                        <b>{{ totalPrice }} $</b>
                    </li>
                    <li class=" d-flex align-items-center me-5 text-secondary nav-item ">
                        <router-link v-if="token" :to="{name: 'favorites'}">
                            <span>Bookmarks</span>
                            <i class="far fa-heart m-1"></i>
                        </router-link>
                    </li>

                    <li v-if="token" class=" d-flex align-items-center me-5 text-secondary nav-item ">
                        <a href="/admin">
                            <span>Admin</span>
                            <i class="fas fa-user-cog m-1"></i>
                        </a>
                    </li>
                    <li v-if="token" class=" d-flex align-items-center me-5 text-secondary nav-item ">
                        <span>Profile</span>
                        <i class="dropdown-icon far fa-user-circle m-1"></i>
                    </li>
                </ul>
            </div>
            <div class="dropdown me-5 ">
                <button class="btn btn-default dropdown-toggle text-muted" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    Options
                </button>
                <ul class="dropdown-menu">
                    <li class="d-flex">
                        <!--                        <router-link class="dropdown-item" :to="{name: 'profile', id: '2'}">Profile</router-link>-->
                    </li>
                    <li v-if="token">
                        <a class="dropdown-item" :href="`admin`">Admin</a>
                    </li>
                    <!--                    <li><a @click="()=> emit('logout')" class="dropdown-item" >Logout</a></li>-->
                    <li>
                        <router-link class="dropdown-item" v-if="!token" :to="{name: 'login'}">Sign in</router-link>
                    </li>
                    <li>
                        <router-link class="dropdown-item" v-if="!token" :to="{name: 'register'}">Sign up</router-link>
                    </li>
                    <li>
                        <router-link @click.prevent="Logout" v-if="token" class="dropdown-item" to="#">Logout
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script setup>
import axios from 'axios';
import router from "@/router/index.js";

const token = localStorage.getItem('token')

const emit = defineEmits(['openDrawer'])

defineProps({
    totalPrice: Number,
})


const Logout = async () => {
    await axios.post('/logout')
        .then(res => {
            localStorage.removeItem('token')
            router.push({name: 'login'})
        })

}
</script>

<style scoped>
.li-cart{
    cursor: pointer;
}
</style>
