<template>
<!--    <Drawer/>-->
    <div class="container bg-white w-75 m-auto rounded-3 shadow-lg mt-5 ">
        <Header/>
        <div class="p-3 mt-3">
        <h2 class="fw-bold text-xl">All products</h2>
        </div>
        <CardList/>
    </div>
</template>

<script setup>
import Header from "./components/Header.vue";
import CardList from "./components/CardList.vue";
import Drawer from "./components/Drawer/Index.vue";
</script>

<style scoped>

</style>
