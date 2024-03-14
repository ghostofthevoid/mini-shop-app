<script setup>
import {ref} from "vue";
import router from "@/router/index.js";

const formData = ref({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
})

const register = async () => {
    console.log(formData.value)
    await axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/register', formData.value ?? {})
            .then(res => {
                console.log(res)
                localStorage.setItem('token', res.config.headers['X-XSRF-TOKEN'])
                router.push('/client')
            }).catch(err => {
            console.log(err.response)
        })
    });
}
</script>

<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <form method="POST">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" required
                                           autocomplete="name" v-model="formData.name" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control " name="email" required
                                           v-model="formData.email" autocomplete="email">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control " name="password" required
                                           v-model="formData.password"  autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm
                                    Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           v-model="formData.password_confirmation" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button @click.prevent="register" type="submit" class="btn btn-submit">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>
