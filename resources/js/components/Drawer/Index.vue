<template>
    <div class="drawer-black position-fixed bg-black "></div>
    <div class="drawer-white bg-white position-fixed p-3">
        <DrawerHead/>
        <CartItemList/>

        <div>
            <div class="d-flex mt-3">
                <span>Total:</span>
                <div class="flex-grow-1 border-bottom "></div>
                <b>$ 1200</b>
            </div>
            <div class="d-flex mt-3">
                <span>Tax:</span>
                <div class="flex-grow-1 border-bottom "></div>
                <b>$ 120</b>
            </div>
            <button :disabled="false" class="btn w-100 rounded-4 mt-3 fw-bold ">Checkout -></button>
        </div>
    </div>

</template>

<script setup>
import DrawerHead from "./DrawerHead.vue";
import CartItemList from "./CartItemList.vue";


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
.btn{
    color: white;
    background-color: #05c75b;
    transition: 0.2s;
}
.btn:hover{
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
