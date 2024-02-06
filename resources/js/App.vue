<template>
    <Drawer v-if="drawer"
            :total-price="totalPrice"
            :vat-price="vatPrice"
            :cart-button-disabled="cartButtonDisabled"
            @creat-order="creatOrder"/>
    <div class="container bg-white w-75 m-auto rounded-3 shadow-lg mt-5 ">
        <Header :total-price="totalPrice" @openDrawer="openDrawer"/>
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
    </div>
</template>

<script setup>
import {onMounted, reactive, ref, watch, provide, computed} from "vue";
import Header from "./components/Header.vue";
import CardList from "./components/CardList.vue";
import Drawer from "./components/Drawer/Index.vue";

const products = ref([])
const cart = ref([])

const drawer = ref(false)
const isCreatingOrder = ref(false)
const filters = reactive({
    sortBy: '',
    searchQuery: ''
})

//Computed
const totalPrice = computed(
    () => cart.value.reduce((sum, prod) => sum + Number(prod.price), 0)
)

const vatPrice = computed(() => Math.round((totalPrice.value * 5) / 100))

const cartIsEmpty = computed(() => cart.value.length === 0)
const cartButtonDisabled = computed(
    () => isCreatingOrder.value || cartIsEmpty.value
)

// Methods


const addToCart = (product) => {
    cart.value.push(product)
    product.isAdded = true
}

const removeFromCart = (product) => {
    cart.value.splice(cart.value.indexOf(product), 1)
    product.isAdded = false
}

const onClickAction = (product) => {
    if (!product.isAdded) {
        addToCart(product)
    } else {
        removeFromCart(product)
    }
    console.log(cart.value)
}

const closeDrawer = () => {
    drawer.value = false
}

const openDrawer = () => {
    drawer.value = true
}

const onChangSelect = event => {
    filters.sortBy = event.target.value
}
const onChangeSearchInput = event => {
    filters.searchQuery = event.target.value
}

const creatOrder = async () => {
    isCreatingOrder.value = true
    try {
        const {data} = await axios.post('/api/orders', {
            products: cart.value,
            totalPrice: totalPrice.value
        })
        cart.value = []
        products.value = products.value.map((prod) => ({
            ...prod,
            isAdded: false
        }))
        return data
    } catch (err) {
        console.log(err)
    }
    isCreatingOrder.value = false
}
const fetchFavorites = async () => {
    try {
        const {data: favorites} = await axios.get("/api/favorites")
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
        } else {
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
        await fetchFavorites()
    } catch (e) {
        console.log(e)
    }
}

const getLocalCart = () => {
    const localCart = localStorage.getItem('cart')
    cart.value = localCart ? JSON.parse(localCart) : []
}


provide('cart', {
    cart,
    closeDrawer,
    openDrawer,
    addToCart,
    removeFromCart
})

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
    localStorage.setItem('cart', JSON.stringify(cart.value))
}, {deep: true})


</script>

<style scoped>
select {
    height: 2rem;
    width: 10rem;
}
</style>
