<template>
   <div class=" h-100">
       <Drawer v-if="drawer"
               :total-price="totalPrice"
               :vat-price="vatPrice"
       />
       <div class="container bg-white w-75 m-auto rounded-3 shadow-lg mt-5 ">
           <Header :total-price="totalPrice"
                   @logout="logout"
                   @openDrawer="openDrawer"/>

           <router-view />
       </div>
   </div>
</template>

<script setup>
import {computed, onMounted, provide, ref, watch} from "vue";
import Header from "./components/Header.vue";
import Drawer from "./components/Drawer/Index.vue";
import {mapActions, useStore} from "vuex";
import useRouter from "./router/index.js";


const store = useStore()
const user = computed(() => store.state.auth.user)
console.log(store.state.auth.user)
const {signOut} = mapActions({
    signOut: "auth/logout"
});
const router = useRouter;

const cart = ref([])
const drawer = ref(false)


//Computed

const totalPrice = computed(
    () => cart.value.reduce((sum, prod) => sum + Number(prod.price), 0)
)

const vatPrice = computed(() => Math.round((totalPrice.value * 5) / 100))


// Methods

async function logout() {
    try {
        const {data} = await axios.post('/logout');
        console.log(data)
        await signOut();
        await router.push({name: "login"});
    } catch (error) {
        // Handle error
        console.error('Logout failed:', error);
    }
}

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

watch(cart, () => {
    localStorage.setItem('cart', JSON.stringify(cart.value))
}, {deep: true})


provide('cart', {
    cart,
    closeDrawer,
    openDrawer,
    addToCart,
    removeFromCart,
})


</script>

<style scoped>

</style>
