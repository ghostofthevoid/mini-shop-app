<template>
 <div class="mt-3 ">
     <h2 class="fw-bold text-xl ms-2">All bookmarks</h2>
     <CardList :products="favorites" is-favorites />
 </div>
</template>

<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";
import CardList from "../components/CardList.vue";

const favorites = ref([])

onMounted(async () => {
    try {
        const {data} = await axios.get('/client/favorites')
        favorites.value = data.data
        console.log(data)
    } catch (err) {
        console.log(err)
    }
})
</script>

<style scoped>

</style>
