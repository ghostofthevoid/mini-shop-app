<template>
    <div class="drawer-black position-fixed bg-black "></div>
    <div class="drawer-white bg-white position-fixed p-3" v-auto-animate>
        <DrawerHead/>

        <div v-if="!totalPrice || orderId" class="d-flex h-100 align-items-center">

            <InfoBlock v-if="!totalPrice && !orderId"
                title="Cart is empty"
                description="Add at least one product to place an order"
                image-url="/images/empty-cart.jpg"/>

            <InfoBlock v-if="orderId"
                title="Order is processed"
                :description="`Your order #${orderId} will soon be transferred to the courier delivery`"
                image-url="/images/complete-order.jpg"/>
        </div>
        <div v-else>
            <CartItemList/>
            <div class="d-flex mt-3">
                <span>Total:</span>
                <div class="flex-grow-1 border-bottom "></div>
                <b>$ {{ totalPrice }}</b>
            </div>
            <div class="d-flex mt-3">
                <span>Tax:</span>
                <div class="flex-grow-1 border-bottom "></div>
                <b>$ {{ vatPrice }}</b>
            </div>
            <button :disabled="cartButtonDisabled"
                    @click="creatOrder"
                    class="btn w-100 rounded-4 mt-3 fw-bold ">Checkout ->
            </button>

        </div>
    </div>

</template>

<script setup>
import DrawerHead from "./DrawerHead.vue";
import CartItemList from "./CartItemList.vue";
import InfoBlock from "./InfoBlock.vue";
import {computed, inject, ref} from "vue";



const isCreating = ref(false)
const orderId = ref(null)


const {cart, closeDrawer} = inject('cart')


const props = defineProps({
    totalPrice: Number,
    vatPrice: Number,
})

const creatOrder = async () => {
    isCreating.value = true
    try {
        const {data} = await axios.post('/api/orders', {
            products: cart.value,
            totalPrice: props.totalPrice.value
        })
        cart.value = []
        orderId.value = data.id
    } catch (err) {
        console.log(err)
    }
    isCreating.value = false
}

const cartIsEmpty = computed(() => cart.value.length === 0)
const cartButtonDisabled = computed(
    () => isCreating.value || cartIsEmpty.value
)

</script>

<style scoped>
.drawer-black {
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 10;
    opacity: 65%;
}

.drawer-white {
    top: 0;
    right: 0;
    width: 350px;
    height: 100%;
    z-index: 20;
}

.btn {
    color: white;
    background-color: #05c75b;
    transition: 0.2s;
}

.btn:hover {
    background-color: #00b44e;
    transition: 0.2s;
}

.btn:active {
    background-color: white;
    color: #00b44e;
    border-color: #00b44e;
}

.btn:disabled {
    background-color: #848b96;
}

</style>
