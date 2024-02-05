<template>
    <div class="row position-relative">
        <Card v-for="product in products"
              :key="product.id"
              :id="product.id"
              :title="product.title"
              :imageUrl="product.image_url"
              :price="Number(product.price)"
              :is-favorite="product.isFavorite"
              :isAdded="product.isAdded"
              :onClickFavorite="() => emit('addToFavorite', product)"
              :onClickAdd="onClickAdd"/>

    </div>
</template>

<script setup>

import Card from "./Card.vue";

const emit = defineEmits(['addToFavorite'])

// methods



//Props
defineProps({
    products: Array,

})

</script>

<style scoped>

</style>
