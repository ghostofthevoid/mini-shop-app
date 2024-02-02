<template>
    <div class="d-flex align-items-center mb-2">
        <svg class="back-btn fa-rotate-180 mb-2"
             width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 7H14.7143" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8.71436 1L14.7144 7L8.71436 13" stroke="black" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round"/>
        </svg>
        <h2 class="fw-bold ms-2 text-lg">Cart</h2>
    </div>
</template>

<script setup>

</script>

<style scoped>
.back-btn {
    opacity: 30%;
    cursor: pointer;
    transition: 0.3s;
}

.back-btn:hover {
    opacity: 100%;
    transition: 0.3s;
    translate: 1px;
}
</style>
