<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card m-5">
                    <div class="card-header fw-bold">Login</div>

                    <div class="card-body bg-white">
                        <form action="">
                            <div class="row mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                <div class="col-mb-6">
                                    <input type="email" v-model="obj.email" class="form-control"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <div class="col-mb-6">
                                    <input type="password" v-model="obj.password" class="form-control"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 ">
                                    <input @click.prevent="login" type="submit" class="btn submit-btn">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import {ref} from "vue";
import router from "../router/index.js";

const obj = ref({
    email: null,
    password: null,
})

const login = async () => {
    await axios.get('/sanctum/csrf-cookie')
        .then(() => {
            axios.post('/login', obj.value)
                .then(response => {
                    localStorage.setItem('x-xsrf-token', response.config.headers['X-XSRF-TOKEN'])

                    obj.value.email = null;
                    obj.value.password = null;
                    router.push({name: 'home'})
                })
                .catch(error => {
                    console.error('Error during login:', error);
                });
        })
        .catch(error => {
            console.error('Error retrieving CSRF token:', error);
        });
}


</script>

<style scoped>
.card-header {
    background-color: #05c75b;
    color: #ffffff;
}

.submit-btn {
    background-color: #05c75b;
    color: white;
}

input {

}

input:focus, input.form-control:focus {
    border-color: #00b44e;
    outline: none !important;
    box-shadow: none;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
}

</style>
