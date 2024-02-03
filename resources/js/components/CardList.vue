<template>
    <div class="row position-relative">
        <Card v-for="product in products"
              :key="product.id"
              :title="product.title"
              :imageUrl="product.image_url"
              :price="Number(product.price)"
              :is-favorite="true"
              :isAdded="true"
              :onClickAdd="onClickAdd"/>

    </div>
</template>

<script setup>

import Card from "./Card.vue";

// methods

const onClickAdd = () => {
    alert("Add?")
}

//Props
defineProps({
    products: Object,

})

</script>

<style scoped>

</style>
