<template>
    <div class="d-flex flex-column flex-grow-1">
        <CartItem v-for="product in cart"
                  :key="product.id"
                  :id="product.id"
                  :imageUrl="product.image_url"
                  :price="product.price"
                  @onClickRemove="() => removeFromCart(product)"
                  :title="product.title"/>


    </div>
</template>

<script setup>
import CartItem from "./CartItem.vue";
import {inject} from "vue";

const {cart, removeFromCart} = inject('cart')

</script>

<style scoped>

</style>
