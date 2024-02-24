<template>

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
    <CardList :products="products"
              @add-to-cart="onClickAction"
              @addToFavorite="addToFavorite"/>

</template>

<script setup>

import CardList from "../components/CardList.vue";
import {inject, onMounted, reactive, ref, watch} from "vue";
import debounce from 'lodash.debounce';

const products = ref([])
const {cart, addToCart, removeFromCart} = inject('cart')
const filters = reactive({
    sortBy: '',
    searchQuery: ''
})

//Methods
const onClickAction = (product) => {
    if (!product.isAdded) {
        addToCart(product)
    } else {
        removeFromCart(product)
    }
    console.log(cart.value)
}

const fetchFavorites = async () => {
    try {
        const {data: favorites} = await axios.get("/client/favorites")
        products.value = products.value.map(product => {
            const favorite = favorites.data.find(favorite => favorite.id === product.id)

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

        const {data} = await axios.get("/client/products", {params})
        if (data.data) {
            products.value = data.data.map((obj) => ({
                ...obj,
                isFavorite: false,
                favoriteId: null,
                isAdded: false
            }))
        }
        await fetchFavorites()
    } catch (e) {
        console.log(e)
    }
}

const onChangSelect = event => {
    filters.sortBy = event.target.value
}
const onChangeSearchInput = debounce((event) => {
    filters.searchQuery = event.target.value
}, 500);
const addToFavorite = async (product) => {
    try {
        if (!product.isFavorite) {
            const obj = {
                product_id: product.id
            }
            product.isFavorite = true
            const {data} = await axios.post("/client/favorites", obj)
            console.log(data.id)
            product.favoriteId = data.id
        } else {
            product.isFavorite = false
            await axios.delete(`/client/favorites/${product.favoriteId}`)
            product.favoriteId = null
        }
    } catch (err) {
        console.log(err)
    }
}
const getLocalCart = () => {
    const localCart = localStorage.getItem('cart')
    cart.value = localCart ? JSON.parse(localCart) : []
}


onMounted(async () => {
    await fetchItems()
    await getLocalCart()

    products.value = products.value.map((item) => ({
        ...item,
        isAdded: cart.value.some(cartItem => cartItem.id === item.id)

    }))

})

watch(filters, fetchItems)
watch(cart, () => {
        products.value = products.value.map((prod) => ({
            ...prod,
            isAdded: false
        }))
})


</script>

<style scoped>
select {
    height: 2rem;
    width: 10rem;
}
</style>
