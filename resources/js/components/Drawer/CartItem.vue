<template>
    <div class=" d-flex align-items-center border border-gray p-2 rounded-2 mb-2">
        <img src="/images/iPhone11.jpg" alt="" class="prod-img me-2">

        <div class="d-flex flex-column ">
            <p>iPhone 11</p>

            <div class="d-flex justify-content-between align-items-center">
                <b>$ 1200</b>

                <img src="/images/remove.svg" alt="" class="remove-img">

            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>
.prod-img {
    height: 6em;
    width: 5em;
}

.remove-img {
    height: 22px;
    cursor: pointer;
    opacity: 30%;
    margin-left: 140px;
    transition: 0.3s;
}

.remove-img:hover {
    opacity: 100%;
    translate: 1px;
    transition: 0.3s;

}
</style>
