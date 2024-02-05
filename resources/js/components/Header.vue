<template>
    <header>
        <nav class="navbar navbar-expand-lg d-flex justify-content-between position-relative border-bottom border-success">
            <div class="d-flex align-items-center" >
                <img src="/images/store.png" alt="Logo" class="rounded-circle ">
                <div class="ms-3">
                    <h3 class="text-success fw-bold mt-3 text-uppercase">Vue store</h3>
                    <p class="text-muted mx-3 ">The best store!</p>
                </div>
            </div>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu"
                    aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navmenu">
            <ul class=" d-flex align-items-center  py-3 navbar-nav ms-auto">
                <li @click="()=>emit('openDrawer')"
                    class=" d-flex align-items-center me-5 text-secondary nav-item ">
                    <i class="fas fa-shopping-cart"></i>
                    <b>1200 $</b>
                </li>
                <li class=" d-flex align-items-center me-5 text-secondary nav-item ">
                    <span>Bookmarks</span>
                    <i class="far fa-heart m-1"></i>
                </li>
                <li class=" d-flex align-items-center me-5 text-secondary nav-item ">
                    <span>Profile</span>
                    <i class="far fa-user-circle m-1"></i>
                </li>
            </ul>
            </div>
        </nav>
    </header>
</template>

<script setup>

const emit = defineEmits(['openDrawer'])
</script>

<style scoped>
li:hover {
    color: #18ab6d !important;
    cursor: pointer;
}
</style>
