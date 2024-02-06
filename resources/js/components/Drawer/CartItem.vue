<template>
    <div class=" d-flex align-items-center border border-gray p-2 rounded-2 mb-2">
        <img :src="imageUrl" :alt="title" class="prod-img me-2">

        <div class="container-fluid d-flex flex-column">
            <p>{{ title }}</p>

            <div class="d-flex justify-content-between align-items-center ">
                <b>$ {{ price }}</b>

                <img @click="emit('onClickRemove')" src="/images/remove.svg" alt="" class="remove-img">

            </div>
        </div>
    </div>
</template>

<script setup>

const emit = defineEmits(['onClickRemove'])
defineProps({
    id: Number,
    title: String,
    imageUrl: String,
    price: Number,
})
</script>

<style scoped>
.prod-img {
    height: 6em;
    width: 5em;
}

.remove-img {
    height: 22px;
    cursor: pointer;
    opacity: 30%;
    transition: 0.3s;
}

.remove-img:hover {
    opacity: 100%;
    translate: 1px;
    transition: 0.3s;

}
</style>
