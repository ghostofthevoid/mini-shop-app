<template>
    <div class="col-md-4 col-xl-3">
        <div class="card mt-3 bg-white rounded-4">
            <div class="position-relative ">

                <div class="bg-image hover-overlay card-img ripple ripple-surface ripple-surface-light">
                    <img :src="imageUrl" alt="" class="img-thumbnail">
                </div>
                <h4 class="px-2 pt-2 fw-bold">{{ title }}</h4>
                <div class="rounded text-center border p-3">
                    <p>{{ description ?? 'Description' }}</p>
                </div>
                <div class=" d-flex justify-content-between p-3">
                    <div class="d-flex flex-column">
                        <b>Price:</b>
                        <span class="text-muted">$ {{ price }}</span>
                    </div>
                    <div v-if="token" class="">
                        <img v-if="onClickFavorite"
                            @click="onClickFavorite"
                             :src="!isFavorite ? '/images/heart.svg' : '/images/liked.svg'"
                             alt="like 1"
                             class="m-1">
                        <img v-if="onClickAdd"
                            @click="onClickAdd"
                             :src="!isAdded ? '/images/btn-plus.svg' : '/images/btn-checked.svg'"
                             alt="plus" class="m-1 border rounded">
                    </div>
                    </div>

            </div>
        </div>
    </div>
</template>

<script setup>

const token = localStorage.getItem('token')

const props = defineProps({
    id: Number,
    title: String,
    description: String,
    imageUrl: String,
    price: Number,
    isFavorite: Boolean,
    isAdded: Boolean,
    onClickAdd: Function,
    onClickFavorite: Function,
})


</script>

<style scoped>
.card {
    transition: 0.3s;
    border: none;
}
.card:hover {
    transform: translateY( -3px);
    cursor: pointer;
    box-shadow: 0px 10px 20px 5px rgba(0, 0, 0, 0.3);
    transition: 0.3s;
}

</style>
