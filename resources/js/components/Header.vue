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
                    <li @click="()=>emit('openDrawer')"
                        class=" d-flex align-items-center me-5 text-secondary nav-item ">
                        <i class="fas fa-shopping-cart"></i>
                        <b>{{ totalPrice }} $</b>
                    </li>
                    <router-link :to="{name: 'favorites'}">
                        <li class=" d-flex align-items-center me-5 text-secondary nav-item ">
                            <span>Bookmarks</span>
                            <i class="far fa-heart m-1"></i>
                        </li>
                    </router-link>

                    <a :href="`admin`">
                        <li class=" d-flex align-items-center me-5 text-secondary nav-item ">
                            <span>Admin</span>
                            <i class="fas fa-user-cog m-1"></i>
                        </li>
                    </a>
                    <li class=" d-flex align-items-center me-5 text-secondary nav-item ">
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
                    <li class="d-flex"><a class="dropdown-item"  href="#">Profile</a></li>
                    <li><a class="dropdown-item"  :href="`admin`">Admin</a></li>
<!--                    <li><a @click="()=> emit('logout')" class="dropdown-item" >Logout</a></li>-->
                    <li>
                        <router-link  class="dropdown-item" to="#">Sign in</router-link>
                    </li>
                    <li>
                        <router-link  class="dropdown-item" to="#">Sign up</router-link>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script setup>
const emit = defineEmits(['openDrawer'])

defineProps({
    totalPrice: Number,
})

</script>

<style scoped>
li:hover {
    color: #18ab6d !important;
    cursor: pointer;
}

a {
    text-decoration: none;
}
</style>
