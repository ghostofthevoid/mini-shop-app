<template>
    <!--    <Drawer/>-->
    <div class="container bg-white w-75 m-auto rounded-3 shadow-lg mt-5 ">
        <Header/>
        <div class="p-3 mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold text-xl">All products</h2>

                <div class="d-flex ">
                    <select @change="onChangSelect" class="form-select me-3 mt-1">
                        <option value="norm" >Sort</option>
                        <option value="title">By name</option>
                        <option value="-price">Price, high to low </option>
                        <option value="price">Price, low to high </option>
                    </select>

                    <div class="position-relative">
                        <img class="search-img position-absolute ms-3 mt-2"
                             src="/images/search.svg" alt="">

                        <input type="text"
                               class="form-control ps-5"
                               placeholder="Search...">
                    </div>

                </div>

            </div>
        </div>
        <CardList :products="products"/>
    </div>
</template>

<script setup>
import {onMounted, ref, watch} from "vue";
import Header from "./components/Header.vue";
import CardList from "./components/CardList.vue";
import Drawer from "./components/Drawer/Index.vue";

const products = ref([])

const sortBy = ref('')
const searchQuery = ref('')


// methods

const onChangSelect = event => {
    sortBy.value = event.target.value
}

onMounted(async () => {
    try {
        const {data} = await axios.get("/api/products", {})
        products.value = data.data
    } catch (e) {
        console.log(e)
    }
})

watch(sortBy,async () => {
    console.log(typeof sortBy.value)
    try {
        const {data} = await axios.post("/api/filter", {
            'value': sortBy.value
        })
        products.value = data.data
    } catch (e) {
        console.log(e)
    }
})

</script>

<style scoped>
select {
    height: 2rem;
    width: 10rem;
}
</style>
