<template>
    <div class="bg-white w-75 m-auto rounded-3 shadow-lg mt-5"
         style="height: 500px;">
        <header class=" px-5 d-flex justify-content-between border-bottom border-secondary">
            <div class="d-flex align-items-center ">
                <img src="/images/Logo.jpg" alt="Logo" class="rounded-circle border border-success mx-3">
                <div class="ml-2">
                    <h3 class="text-success fw-bold mt-3 text-uppercase">Vue store</h3>
                    <p>The best store!</p>
                </div>
            </div>
                <ul>
                    <li>
                        <i class="fas fa-shopping-cart"></i>
                        <b>1200 $</b>
                    </li>
                    <li>
                        <i class="far fa-heart"></i>
                        <b>Bookmarks</b>
                    </li>
                    <li>
                        <i class="far fa-user-circle"></i>
                        <b>Profile</b>
                    </li>
                </ul>
        </header>
    </div>
</template>

<script>
import ExampleComponent from "./components/ExampleComponent.vue";

export default {
    name: "App",
    components: {ExampleComponent}
}
</script>

<style scoped>

</style>
