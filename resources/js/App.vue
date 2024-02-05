<template>
    <!--    <Drawer/>-->
    <div class="container bg-white w-75 m-auto rounded-3 shadow-lg mt-5 ">
        <Header/>
        <div class="p-3 mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold text-xl">All products</h2>

                <div class="d-flex ">
                    <select @change="onChangSelect" class="form-select me-3 mt-1">
                        <option value="norm">Sort</option>
                        <option value="title">By name</option>
                        <option value="-price">Price, high to low</option>
                        <option value="price">Price, low to high</option>
                    </select>

                    <div class="position-relative">
                        <img class="search-img position-absolute ms-3 mt-2"
                             src="/images/search.svg" alt="">

                        <input @input="onChangeSearchInput"
                               type="text"
                               class="form-control ps-5"
                               placeholder="Search...">
                    </div>

                </div>

            </div>
        </div>
        <CardList :products="products" @addToFavorite="addToFavorite"/>
    </div>
</template>

<script setup>
import {onMounted, reactive, ref, watch, provide} from "vue";
import Header from "./components/Header.vue";
import CardList from "./components/CardList.vue";
import Drawer from "./components/Drawer/Index.vue";

const products = ref([])

const filters = reactive({
    sortBy: '',
    searchQuery: ''
})

// methods

const onChangSelect = event => {
    filters.sortBy = event.target.value
}
const onChangeSearchInput = event => {
    filters.searchQuery = event.target.value
}

const fetchFavorites = async () => {
    try {
        const {data: favorites} = await axios.get("/api/favorites")
        console.log(favorites)
        console.log(products.value)
        products.value = products.value.map(product => {
            const favorite = favorites.find(favorite => favorite.parentId === product.id)

            if (!favorite) {
                return product
            }

            return {
                ...product,
                isFavorite: true,
                favoriteId: favorite.id
            }
        })
    } catch (e) {
        console.log(e)
    }
}

const addToFavorite = async (product) => {
    try {
        if (!product.isFavorite) {
            const obj = {
                parentId: product.id
            }
            product.isFavorite = true
            const {data} = await axios.post("/api/favorites", obj)
            console.log(data.id)
            product.favoriteId = data.id
        }else {
            product.isFavorite = false
            await axios.delete(`/api/favorites/${product.favoriteId}`)
            product.favoriteId = null
        }
    } catch (err) {
        console.log(err)
    }
}

const fetchItems = async () => {
    try {
        const params = {}

        if (filters.sortBy === 'title') {
            params.byTitle = filters.sortBy
        }
        if (filters.sortBy === 'price') {
            params.byPriceAsc = filters.sortBy
        }
        if (filters.sortBy === '-price') {
            params.byPriceDesc = filters.sortBy
        }
        if (filters.searchQuery) {
            params.searchInput = filters.searchQuery
        }

        const {data} = await axios.get("/api/products", {params})
        if (data.data) {
            products.value = data.data.map((obj) => ({
                ...obj,
                isFavorite: false,
                favoriteId: null,
                isAdded: false
            }))
        }
    } catch (e) {
        console.log(e)
    }
}

provide('addToFavorite', addToFavorite)

onMounted(async () => {
    await fetchItems()
    await fetchFavorites()
})

watch(filters, fetchItems)

</script>

<style scoped>
select {
    height: 2rem;
    width: 10rem;
}
</style>
