<template>
    <Drawer v-if="drawer"
            :total-price="totalPrice"
            :vat-price="vatPrice"
            :cart-button-disabled="cartButtonDisabled"
            @creat-order="creatOrder"/>
    <div class="container bg-white w-75 m-auto rounded-3 shadow-lg mt-5 ">
        <Header :total-price="totalPrice" @openDrawer="openDrawer"/>
     <router-view />
    </div>

</template>

<script setup>
import {onMounted, reactive, ref, watch, provide, computed} from "vue";
import Header from "./components/Header.vue";
import Drawer from "./components/Drawer/Index.vue";



const cart = ref([])

const drawer = ref(false)
const isCreatingOrder = ref(false)


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
const closeDrawer = () => {
    drawer.value = false
}
const openDrawer = () => {
    drawer.value = true
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


watch(cart, () => {
    localStorage.setItem('cart', JSON.stringify(cart.value))
}, {deep: true})


provide('cart', {
    cart,
    closeDrawer,
    openDrawer,
    addToCart,
    removeFromCart
})


</script>

<style scoped>
select {
    height: 2rem;
    width: 10rem;
}
</style>
