<template>
    <div class="d-flex flex-column align-items-center text-center mx-auto">
        <img :src="imageUrl" alt="">
        <h2 class="mt-1 text-success">{{title}}</h2>
        <p class="text-muted">{{description}}</p>
    </div>
</template>

<script setup>
defineProps({
    title: String,
    description: String,
    imageUrl: String
})
</script>

<style scoped>
img {
    height: 70px;
    width: 70px;
}
</style>
