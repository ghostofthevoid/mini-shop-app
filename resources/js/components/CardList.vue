<template>
    <div class="row position-relative">
        <Card title="iPhone 11" imageUrl="/images/iPhone11.jpg"
        :price="1200" :is-favorite="true"
        :onClickAdd="onClickAdd"/>
    </div>
</template>

<script setup>
import Card from "./Card.vue";

// methods

const onClickAdd = () => {
    alert("Add?")
}

</script>

<style scoped>

</style>
