<template>
    <div class="row position-relative" v-auto-animate>
        <Card v-for="product in products"
              :key="product.id"
              :id="product.id"
              :title="product.title"
              :description="product.description"
              :imageUrl="product.image_url"
              :price="Number(product.price)"
              :is-favorite="product.isFavorite"
              :isAdded="product.isAdded"
              :onClickFavorite="isFavorites ? null : () => emit('addToFavorite', product)"
              :onClickAdd="isFavorites ? null : () => emit('addToCart', product)"/>

    </div>
</template>

<script setup>

import Card from "./Card.vue";

const emit = defineEmits(['addToFavorite', 'addToCart'])

// methods


//Props
defineProps({
    products: Array,
    isFavorites: Boolean,
})

</script>

<style scoped>

</style>
